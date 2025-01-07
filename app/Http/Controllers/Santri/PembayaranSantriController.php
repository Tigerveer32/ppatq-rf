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
        $pembayaran = Pembayaran::where('id_santri', $santri->id_santri)->get();
        
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

        // Simpan data pembayaran
        $pembayaran = Pembayaran::create([
            'status' => 'pending',
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

        return redirect()->route('santri.pembayaran.checkout', ['id_pembayaran' => $pembayaran->id])
                     ->with('success', 'Pembayaran berhasil disimpan. Silakan lanjutkan ke halaman checkout.');     
    }

    // Menampilkan halaman checkout
    public function checkout($id_pembayaran)
    {
        // Ambil pembayaran berdasarkan ID
        $pembayaran = Pembayaran::findOrFail($id_pembayaran);
        //dd($pembayaran);
        $pembayaran_detail = PembayaranDetail::where('id_pembayaran', $id_pembayaran)->get();
    
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $transactionDetails = [
            'order_id' => 'ORDER-' . time(), // Gunakan ID unik untuk transaksi
            'gross_amount' => $pembayaran->total_bayar, // Total pembayaran
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
            'customer_details' => $customerDetails,
        ];

        // Request ke Midtrans untuk membuat token
        $snapToken = \Midtrans\Snap::getSnapToken($transactionData);
        $pembayaran->update(['snap_token' => $snapToken]);
        // Cek jika pembayaran sudah berhasil
        if ($pembayaran->status === 'success') {
            return redirect()->route('santri.pembayaran.index')->with('success', 'Pembayaran telah berhasil.');
        }
    
        // Tampilkan halaman checkout dengan detail pembayaran
        return view('santri.pembayaran.checkout', compact('pembayaran', 'pembayaran_detail'));
    }

    public function midtransCallback(Request $request)
    {
       // Mengambil payload dari request
        $payload = $request->all();
        $orderId = $payload['order_id'];  // ID transaksi dari Midtrans
        $transactionStatus = $payload['transaction_status'];  // Status transaksi
        $fraudStatus = $payload['fraud_status'] ?? null;  // Status fraud, jika ada

        // Mencari pembayaran berdasarkan order_id
        $pembayaran = Pembayaran::where('id_pembayaran', $orderId)->first();
        dd($pembayaran); 
        if (!$pembayaran) {
            return response()->json(['status' => 'Transaction not found'], 404);
        }

        // Menangani berbagai status transaksi
        if ($transactionStatus == 'capture') {
            if ($fraudStatus == 'accept') {
                // Pembayaran diterima dan tidak ada fraud
                $pembayaran->update(['status' => 'success']);
            } else {
                // Pembayaran diterima, tapi ada fraud
                $pembayaran->update(['status' => 'fraud']);
            }
        } elseif ($transactionStatus == 'settlement') {
            // Pembayaran berhasil
            $pembayaran->update(['status' => 'success']);
        } elseif ($transactionStatus == 'pending') {
            // Pembayaran masih dalam proses
            $pembayaran->update(['status' => 'pending']);
        } elseif ($transactionStatus == 'deny') {
            // Pembayaran ditolak
            $pembayaran->update(['status' => 'failed']);
        } elseif ($transactionStatus == 'expire') {
            // Pembayaran telah kedaluwarsa
            $pembayaran->update(['status' => 'expired']);
        } elseif ($transactionStatus == 'cancel') {
            // Pembayaran dibatalkan
            $pembayaran->update(['status' => 'canceled']);
        }

            // Jika pembayaran berhasil, redirect ke halaman pembayaran index
            if ($pembayaran->status === 'success') {
                return redirect()->route('santri.pembayaran.index')
                                ->with('success', 'Pembayaran berhasil!');
            }
        

        // Kirim response ke Midtrans untuk konfirmasi callback telah diterima
        return response()->json(['status' => 'OK']);
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
