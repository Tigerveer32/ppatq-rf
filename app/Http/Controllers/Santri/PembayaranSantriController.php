<?php

namespace App\Http\Controllers\Santri;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\PembayaranDetail;
use App\Models\santri; // Gunakan huruf kecil untuk model santri
use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;

class PembayaranSantriController extends Controller
{
    public function __construct()
    {
        // Set konfigurasi Midtrans dari config/midtrans.php
        Config::$serverKey = config('midtrans.serverKey');
        Config::$clientKey = config('midtrans.clientKey');
        Config::$isProduction = config('midtrans.isProduction');
        Config::$isSanitized = config('midtrans.isSanitized');
        Config::$is3ds = config('midtrans.is3ds');
    }
    // Menampilkan halaman pembayaran santri
    public function index()
    {
        $user = auth()->user();
        $santri = $user->santri; // Mengambil data santri yang terkait dengan user yang login

        if (!$santri) {
            return redirect()->route('walsan')->with('error', 'Santri tidak ditemukan!');
        }
        $pembayaran = Pembayaran::where('id_santri', $santri->id)->get();
        
        return view('santri.pembayaran.index', compact('santri', 'pembayaran'));
    }

    // Menampilkan form untuk membuat pembayaran baru
    public function create()
    {
        $user = auth()->user();
        $santri = $user->santri; // Mengambil data santri yang terkait dengan user yang login
        // dd($santri);
        if (!$santri) {
            return redirect()->route('walsan')->with('error', 'Santri tidak ditemukan!');
        }

        return view('santri.pembayaran.create', compact('santri'));
    }

    // Menyimpan pembayaran santri
    public function store(Request $request)
    {
        $user = auth()->user();
        $santri = $user->santri;
        // Validasi input

        // Membuat token pembayaran dengan Midtrans
        $snapToken = $this->createMidtransToken($request);

        // Simpan data pembayaran
        $pembayaran = Pembayaran::create([
            'status' => 'pending',
            'snap_token' => $snapToken,
            'id_santri' => $santri->id_santri,
            'payment_method' => $request->payment_method,
            'total_bayar' => $this->calculateTotalBayar($request),
        ]);

        // Menyimpan detail pembayaran (opsional)
        PembayaranDetail::create([
            'id_pembayaran' => $pembayaran->id,
            'spp' => $request->spp,
            'uang_saku' => $request->uang_saku,
            'infaq' => $request->infaq,
            'cicilan_DaftarUlang' => $request->cicilan_DaftarUlang,
            'Zarkasi' => $request->Zarkasi,
            'Pelunasan_Zarkasi' => $request->Pelunasan_Zarkasi,
            'saku_zarkasi' => $request->saku_zarkasi,
            'ujian' => $request->ujian,
            'arwahan' => $request->arwahan,
            'lain_lain' => $request->lain_lain,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('santri.pembayaran.index', ['id_santri' => $santri->id_santri])
                         ->with('success', 'Pembayaran berhasil disimpan.');     
    }

    private function createMidtransToken(Request $request)
    {
        //dd($request->all());
        // Data untuk membuat transaksi di Midtrans
        $transactionDetails = [
            'order_id' => 'ORDER-' . time(), // Gunakan ID unik untuk transaksi
            'gross_amount' => $request->total, // Total pembayaran
        ];

        $itemDetails = [
            [
                'id' => 'ITEM1',
                'price' => $request->spp,
                'quantity' => 1,
                'name' => 'SPP',
            ],
            [
                'id' => 'ITEM2',
                'price' => $request->uang_saku,
                'quantity' => 1,
                'name' => 'Uang Saku',
            ],
            // Tambahkan item lainnya sesuai dengan input form
        ];

        $user = auth()->user();
        $santri = $user->santri;

        $customerDetails = [
            'first_name' => $santri->nama_santri,  // Ganti dengan nama santri
            'email' => $user->email, // Ganti dengan email santri
            'phone' => $santri->no_hp,  // Ganti dengan nomor telepon
        ];

        $transactionData = [
            'transaction_details' => $transactionDetails,
            'item_details' => $itemDetails,
            'customer_details' => $customerDetails,
        ];

        // Request ke Midtrans untuk membuat token
        $snapToken = Snap::getSnapToken($transactionData);
        return $snapToken;
    }

    // Menampilkan detail pembayaran
    public function show($id_santri, $id_pembayaran)
    {
        $santri = santri::findOrFail($id_santri); // Gunakan huruf kecil untuk model santri
        $pembayaran = Pembayaran::findOrFail($id_pembayaran);
        $pembayaran_detail = PembayaranDetail::where('id_pembayaran', $id_pembayaran)->get();

        return view('santri.pembayaran.show', compact('santri', 'pembayaran', 'pembayaran_detail'));
    }

    // Fungsi untuk menghitung total bayar dari detail pembayaran
    private function calculateTotalBayar(Request $request)
    {
        return (
            $request->spp +
            $request->uang_saku +
            $request->infaq +
            $request->cicilan_DaftarUlang +
            $request->Zarkasi +
            $request->Pelunasan_Zarkasi +
            $request->saku_zarkasi +
            $request->ujian +
            $request->arwahan +
            $request->lain_lain
        );
    }
}
