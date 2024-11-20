<?php

namespace App\Http\Controllers\Tahfidz;

use App\Models\santri;
use App\Models\tahfidz;
use App\Models\Santri_Tahfidz; // Model Santri_Tahfidz
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Hafalan;
use Carbon\Carbon;

class KetahfidzanController extends Controller
{
    public function index()
    {
        // Ambil data user yang sedang login
        $user = Auth::user();

        // Pastikan user memiliki role 'tahfidz'
        if ($user->role == 'tahfidz') {
            // Cari data tahfidz berdasarkan id_pegawai dari user
            $tahfidz = tahfidz::where('id_pegawai', $user->pegawai_id)->first();

            if ($tahfidz) {
                // Ambil semua data dari santri_tahfidz berdasarkan id_tahfidz
                $santriTahfidzList = Santri_Tahfidz::where('id_tahfidz', $tahfidz->id_tahfidz)->get();

                // Ambil id_santri dari tabel santri_tahfidz
                $santriIds = $santriTahfidzList->pluck('id_santri');

                // Ambil data santri berdasarkan id_santri yang didapat
                $santris = santri::whereIn('id_santri', $santriIds)->get();
                // dd($santris);

                // Kirim data ke view
                return view('tahfidz.tahfidz.index', compact('santris', 'tahfidz'));
            }

            // Jika data tahfidz tidak ditemukan
            return redirect()->route('dashboard-tahfidz')->withErrors(['role' => 'Tahfidz data not found.']);
        }

        // Jika user tidak memiliki role tahfidz
        return redirect()->route('login')->with('error', 'Unauthorized access.');
    }

    public function hafalan(Request $request)
    {
        // Ambil data user yang sedang login
        $user = Auth::user();
    
        // Pastikan user memiliki role 'tahfidz'
        if ($user->role == 'tahfidz') {
            // Cari data tahfidz berdasarkan id_pegawai dari user
            $tahfidz = tahfidz::where('id_pegawai', $user->pegawai_id)->first();
    
            // Jika data tahfidz tidak ditemukan, kembalikan ke halaman dashboard
            if (!$tahfidz) {
                return redirect()->route('dashboard-tahfidz')->withErrors(['role' => 'Data tahfidz tidak ditemukan.']);
            }
    
            // Ambil filter bulan dan tahun dari request, default ke bulan dan tahun saat ini
            $selectedBulan = $request->input('bulan', Carbon::now()->format('m'));
            $selectedTahun = $request->input('tahun', Carbon::now()->format('Y'));
    
            // Ambil data hafalan berdasarkan id_tahfidz, bulan, dan tahun
            $hafalans = Hafalan::where('id_tahfidz', $tahfidz->id_tahfidz)
                ->where('bulan', $selectedBulan)
                ->where('tahun', $selectedTahun)
                ->with('santri') // Memuat relasi dengan santri
                ->get();
    
            // Kirim data ke view
            return view('tahfidz.tahfidz.hafalan', compact('tahfidz', 'hafalans', 'selectedBulan', 'selectedTahun'));
        }
    
        // Jika user tidak memiliki role 'tahfidz'
        return redirect()->route('login')->with('error', 'Unauthorized access.');
    }

    public function form()
    {
        // Ambil data user yang sedang login
        $user = Auth::user();
    
        // Pastikan user memiliki role 'tahfidz'
        if ($user->role == 'tahfidz') {
            // Cari data tahfidz berdasarkan id_pegawai dari user
            $tahfidz = Tahfidz::where('id_pegawai', $user->pegawai_id)->first();
    
            if ($tahfidz) {
                // Ambil data santri yang terkait dengan tahfidz ini
                $santris = Santri::whereHas('santriTahfidz', function ($query) use ($tahfidz) {
                    $query->where('id_tahfidz', $tahfidz->id_tahfidz);
                })->get();
    
                // Kirim data ke view
                return view('tahfidz.tahfidz.form', compact('tahfidz', 'santris'));
            }
    
            // Jika data tahfidz tidak ditemukan
            return redirect()->route('dashboard-tahfidz')->withErrors(['role' => 'Tahfidz data not found.']);
        }
    
        // Jika user tidak memiliki role 'tahfidz'
        return redirect()->route('login')->with('error', 'Unauthorized access.');
    }
    

    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'id_santri' => 'required|exists:santri,id_santri',
            'ayat' => 'required|string',
            'surat' => 'required|string',
            'juz' => 'required|integer|min:1|max:30',
            'bulan' => 'required|integer|min:1|max:12',
            'tahun' => 'required|integer|min:2000|max:' . Carbon::now()->year,
        ]);

        // Ambil data user yang sedang login
        $user = Auth::user();

        // Ambil id_tahfidz dari relasi atau atribut yang terkait dengan user yang login
        $tahfidz = Tahfidz::where('id_pegawai', $user->pegawai_id)->first();

        if (!$tahfidz) {
            return redirect()->route('dashboard-tahfidz')->withErrors(['role' => 'Kelompok tahfidz tidak valid.']);
        }

        $id_tahfidz = $tahfidz->id_tahfidz; // Dapatkan id_tahfidz yang terkait dengan user

        // Pastikan santri berada dalam kelompok tahfidz ini
        $santri = Santri::where('id_santri', $request->id_santri)
            ->whereHas('santriTahfidz', function ($query) use ($id_tahfidz) {
                $query->where('id_tahfidz', $id_tahfidz);
            })
            ->first();

        if (!$santri) {
            return redirect()->route('tahfidz.tahfidz.hafalan')->withErrors(['id_santri' => 'Santri tidak ditemukan dalam kelompok tahfidz ini.']);
        }

        // Cek jika hafalan untuk santri ini di bulan yang sama pada tahun yang sama sudah ada
        $existingHafalan = Hafalan::where('id_santri', $request->id_santri)
            ->where('tahun', $request->tahun)
            ->where('bulan', $request->bulan)
            ->first();

        // Jika hafalan sudah ada untuk bulan yang sama dalam tahun yang sama
        if ($existingHafalan) {
            return redirect()->route('tahfidz.tahfidz.hafalan')->withErrors(['id_santri' => 'Hafalan untuk santri ini sudah ada pada bulan dan tahun yang sama.']);
        }

        // Simpan hafalan baru
        Hafalan::create([
            'id_santri' => $request->id_santri,
            'ayat' => $request->ayat,
            'surat' => $request->surat,
            'juz' => $request->juz,
            'bulan' => $request->bulan,
            'tahun' => $request->tahun,
            'id_tahfidz' => $id_tahfidz,
        ]);

        return redirect()->route('tahfidz.tahfidz.hafalan')->with('success', 'Hafalan berhasil ditambahkan!');
    }


public function edit($id)
{
    $hafalan = Hafalan::findOrFail($id);
    $santris = Santri::whereHas('santriTahfidz', function ($query) use ($hafalan) {
        $query->where('id_tahfidz', $hafalan->id_tahfidz);
    })->get(); // Filter santri sesuai kelompok tahfidz
    return view('tahfidz.tahfidz.edit', compact('hafalan', 'santris'));
}

public function update(Request $request, $id)
{
    // Validasi data input
    $request->validate([
        'santri_id' => 'required|exists:santri,id_santri',
        'ayat' => 'required|string',
        'surat' => 'required|string',
        'juz' => 'required|integer|min:1|max:30',
        'bulan' => 'required|integer|min:1|max:12',
        'tahun' => 'required|integer|min:2000|max:' . Carbon::now()->year,
    ]);

    // Ambil data user yang sedang login
    $user = Auth::user();

    // Ambil id_tahfidz dari relasi atau atribut yang terkait dengan user yang login
    $tahfidz = Tahfidz::where('id_pegawai', $user->pegawai_id)->first();

    if (!$tahfidz) {
        return redirect()->route('dashboard-tahfidz')->withErrors(['role' => 'Kelompok tahfidz tidak valid.']);
    }

    $id_tahfidz = $tahfidz->id_tahfidz; // Dapatkan id_tahfidz yang terkait dengan user

    // Pastikan santri berada dalam kelompok tahfidz ini
    $santri = Santri::where('id_santri', $request->santri_id)
        ->whereHas('santriTahfidz', function ($query) use ($id_tahfidz) {
            $query->where('id_tahfidz', $id_tahfidz);
        })
        ->first();

    if (!$santri) {
        return redirect()->route('tahfidz.tahfidz.hafalan')->withErrors(['santri_id' => 'Santri tidak ditemukan dalam kelompok tahfidz ini.']);
    }

    // Cek jika hafalan untuk santri ini di bulan yang sama pada tahun yang sama sudah ada, kecuali hafalan yang sedang diupdate
    $existingHafalan = Hafalan::where('id_santri', $request->santri_id)
        ->where('tahun', $request->tahun)
        ->where('bulan', $request->bulan)
        ->where('id_hafalan', '!=', $id)  // Menghindari validasi pada hafalan yang sedang diupdate
        ->first();

    // Jika hafalan sudah ada untuk bulan yang sama dalam tahun yang sama
    if ($existingHafalan) {
        return redirect()->route('tahfidz.tahfidz.hafalan')->withErrors(['santri_id' => 'Hafalan untuk santri ini sudah ada pada bulan dan tahun yang sama.']);
    }

    // Ambil data hafalan yang ingin diupdate
    $hafalan = Hafalan::where('id_hafalan', $id)->firstOrFail();


    // Update hafalan dengan data baru
    $hafalan->update([
        'id_santri' => $request->santri_id,
        'ayat' => $request->ayat,
        'surat' => $request->surat,
        'juz' => $request->juz,
        'bulan' => $request->bulan,
        'tahun' => $request->tahun,
        'id_tahfidz' => $id_tahfidz,
    ]);

    return redirect()->route('tahfidz.tahfidz.hafalan', $hafalan->id_tahfidz)->with('success', 'Hafalan berhasil diperbarui!');
}


public function destroy($id)
{
    $hafalan = Hafalan::findOrFail($id);
    $hafalan->delete();

    return redirect()->route('tahfidz.tahfidz.hafalan', $hafalan->id_tahfidz)->with('success', 'Hafalan berhasil dihapus!');
}


    
    
}
