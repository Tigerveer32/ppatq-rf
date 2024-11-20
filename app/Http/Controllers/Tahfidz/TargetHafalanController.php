<?php

namespace App\Http\Controllers\Tahfidz;
use App\Models\TargetHafalan;
use App\Models\User;
use App\Models\Santri_Tahfidz;
use App\Models\santri;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\tahfidz;
use App\Models\pegawai;
use App\Models\KodeJuz;
use Carbon\Carbon;
use ArielMejiaDev\LarapexCharts\LarapexChart;


use Illuminate\Http\Request;

class TargetHafalanController extends Controller
{
    public function index(Request $request)
    {
        // Ambil data user yang sedang login
        $user = Auth::user();

        // Pastikan user memiliki role 'tahfidz'
        if ($user->role === 'tahfidz') {
            // Cari data tahfidz berdasarkan id_pegawai dari user
            $tahfidz = tahfidz::where('id_pegawai', $user->pegawai_id)->first();

            if ($tahfidz) {
                // Ambil filter bulan dan tahun dari request, default ke bulan dan tahun saat ini
                $selectedBulan = $request->input('bulan', Carbon::now()->format('m'));
                $selectedTahun = $request->input('tahun', Carbon::now()->format('Y'));

                // Ambil semua data santri_tahfidz yang memiliki id_tahfidz yang sama
                $santriTahfidz = Santri_Tahfidz::where('id_tahfidz', $tahfidz->id_tahfidz)->get();

                // Ambil data santri terkait berdasarkan id_santri dari santri_tahfidz
                $santris = santri::whereIn('id_santri', $santriTahfidz->pluck('id_santri'))->get();

                // Ambil data target hafalan berdasarkan id_tahfidz dan filter bulan dan tahun
                $targetHafalans = TargetHafalan::where('id_tahfidz', $tahfidz->id_tahfidz)
                    ->where('bulan', $selectedBulan)
                    ->where('tahun', $selectedTahun)
                    ->with(['santri', 'kodeJuz']) // Memuat relasi santri dan kode_juz
                    ->get();

                // Kirim data ke view
                return view('tahfidz.target.index', compact('santris', 'tahfidz', 'targetHafalans', 'selectedBulan', 'selectedTahun'));
            }

            // Jika data tahfidz tidak ditemukan
            return redirect()->route('dashboard-tahfidz')->withErrors(['role' => 'Data tahfidz tidak ditemukan.']);
        }

        // Jika user tidak memiliki role tahfidz
        return redirect()->route('login')->with('error', 'Unauthorized access.');
    }
    
    

    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'id_santri' => 'required|exists:santri,id_santri',
            'id_target' => 'required|exists:kode_juz,id',
            'bulan' => 'required|numeric|min:1|max:12',
            'tahun' => 'required|numeric|min:2020|max:' . date('Y'),
        ]);

        // Ambil data user yang sedang login
        $user = Auth::user();

        // Cari data tahfidz berdasarkan id_pegawai dari user
        $tahfidz = tahfidz::where('id_pegawai', $user->pegawai_id)->first();

        if (!$tahfidz) {
            return redirect()->route('dashboard-tahfidz')->withErrors(['role' => 'Kelompok tahfidz tidak valid.']);
        }

        // Pastikan santri berada dalam kelompok tahfidz ini
        $santri = santri::where('id_santri', $request->id_santri)
            ->whereHas('santriTahfidz', function ($query) use ($tahfidz) {
                $query->where('id_tahfidz', $tahfidz->id_tahfidz);
            })
            ->first();

        if (!$santri) {
            return redirect()->route('tahfidz.target.index')->withErrors(['id_santri' => 'Santri tidak ditemukan dalam kelompok tahfidz ini.']);
        }

        // Cek apakah kombinasi bulan dan tahun sudah ada untuk santri ini
        $existingTarget = TargetHafalan::where('id_santri', $request->id_santri)
            ->where('bulan', $request->bulan)
            ->where('tahun', $request->tahun)
            ->first();

        if ($existingTarget) {
            return redirect()->route('tahfidz.target.index')->withErrors([
                'bulan_tahun' => 'Target hafalan untuk bulan dan tahun ini sudah ada untuk santri yang dipilih.',
            ]);
        }

        // Simpan data target hafalan
        TargetHafalan::create([
            'id_tahfidz' => $tahfidz->id_tahfidz,
            'id_santri' => $request->id_santri,
            'id_target' => $request->id_target,
            'bulan' => $request->bulan,
            'tahun' => $request->tahun,
        ]);

        return redirect()->route('tahfidz.target.index')->with('success', 'Target hafalan berhasil ditambahkan!');
    }
    

    public function form()
    {
        // Ambil data tahfidz berdasarkan id_pegawai dari user yang sedang login
        $user = Auth::user();
        $tahfidz = tahfidz::where('id_pegawai', $user->pegawai_id)->first();

        if (!$tahfidz) {
            return redirect()->route('dashboard-tahfidz')->withErrors(['role' => 'Kelompok tahfidz tidak valid.']);
        }

        // Ambil data santri yang ada dalam kelompok tahfidz
        $santris = Santri::whereIn('id_santri', Santri_Tahfidz::where('id_tahfidz', $tahfidz->id_tahfidz)->pluck('id_santri'))->get();

        // Ambil data kode juz untuk target hafalan
        $kodeJuz = KodeJuz::all();

        // Kirim data ke view
        return view('tahfidz.target.form', compact('santris', 'kodeJuz'));
    }

    public function destroy($id)
    {
        // Cari target hafalan berdasarkan ID
        $targetHafalan = TargetHafalan::findOrFail($id);

        // Hapus target hafalan
        $targetHafalan->delete();

        // Redirect ke halaman sebelumnya dengan pesan sukses
        return redirect()->route('tahfidz.target.index')->with('success', 'Target Hafalan berhasil dihapus.');
    }

    public function chart(Request $request)
    {
        $user = Auth::user();
    
        if ($user->role !== 'tahfidz') {
            return redirect()->route('login')->with('error', 'Unauthorized access.');
        }
    
        // Default bulan dan tahun
        $currentDate = Carbon::now();
        $selectedBulan = (int) $request->input('bulan', $currentDate->month); 
        $selectedTahun = (int) $request->input('tahun', $currentDate->year); 
    
        // Ambil data kelompok tahfidz user yang sedang login
        $tahfidzId = $user->pegawai_id;
    
        // Ambil data santri dalam kelompok tahfidz ini
        $santriIds = Santri_Tahfidz::where('id_tahfidz', $tahfidzId)->pluck('id_santri');
        
        // Ambil data target hafalan berdasarkan bulan dan tahun (gunakan whereMonth dan whereYear)
        $targets = TargetHafalan::with('kodeJuz', 'santri')  // Pastikan relasi dengan kodeJuz dan santri di-load
            ->whereIn('id_santri', $santriIds) // Filter berdasarkan bulan
            ->whereYear('tahun', $selectedTahun) 
            ->get();
            
    
        // Data untuk grafik: gabungkan nama santri dan kode juz untuk label
        $labels = $targets->map(function ($target) {
            return $target->santri ? $target->santri->nama_santri . ' (' . $target->kodeJuz->kode . ' - ' . $target->kodeJuz->nama_surah . ')' : 'Unknown';
        });
    
        $series = $targets->map(function ($target) {
            return $target->kodeJuz ? $target->kodeJuz->kode : null;  // Ambil kode atau nilai lain yang Anda butuhkan
        });
        // Membuat grafik Bar Chart
        $chart = (new LarapexChart)->barChart()
            ->setTitle('Grafik Target Hafalan Per Kode Juz dan Santri')
            ->setSubtitle("Bulan: " . Carbon::create()->month($selectedBulan)->translatedFormat('F') . ", Tahun: $selectedTahun") 
            ->addData('Target', $series->toArray())  // Menambahkan kode_juz sebagai data
            ->setXAxis($labels->toArray());
    
        // Kirim data ke view
        return view('tahfidz.grafik.chart', compact('chart', 'selectedBulan', 'selectedTahun'));
    }
    



}
