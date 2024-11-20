<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hafalan;
use App\Models\santri;
use App\Models\tahfidz;
use App\Models\Santri_Tahfidz;
use Carbon\Carbon;

class HafalanController extends Controller
{
    // Menampilkan daftar hafalan santri
    public function hafalan($id_tahfidz, Request $request)
    {
        $tahfidz = Tahfidz::findOrFail($id_tahfidz);
    
        $selectedBulan = $request->input('bulan', Carbon::now()->format('m'));
        $selectedTahun = $request->input('tahun', Carbon::now()->format('Y'));
    
        $hafalans = Hafalan::where('id_tahfidz', $id_tahfidz)
            ->where('bulan', $selectedBulan)
            ->where('tahun', $selectedTahun)
            ->with('santri')
            ->get();
    
        return view('admin.hafalan.hafalan', compact('tahfidz', 'hafalans', 'selectedBulan', 'selectedTahun'));
    }
    
    public function index()
    {
        $tahfidzs = Tahfidz::all();
        return view('admin.hafalan.index', compact('tahfidzs'));
    }

    public function form($id_tahfidz)
    {
        $tahfidz = Tahfidz::findOrFail($id_tahfidz);
        // Mengambil santri yang terdaftar pada tahfidz ini menggunakan relasi
        $santris = Santri::whereHas('santriTahfidz', function ($query) use ($id_tahfidz) {
            $query->where('id_tahfidz', $id_tahfidz);
        })->get(); // Filter santri berdasarkan kelompok tahfidz
        return view('admin.hafalan.form', compact('tahfidz', 'santris'));
    }

    // Menyimpan data hafalan santri
    public function store(Request $request, $id_tahfidz)
    {
        $request->validate([
            'id_santri' => 'required|exists:santri,id_santri',
            'ayat' => 'required',
            'surat' => 'required',
            'juz' => 'required',
            'bulan' => 'required',
            'tahun' => 'required',
        ]);
    
        // Pastikan santri berada dalam kelompok tahfidz ini
        $santri = Santri::where('id_santri', $request->id_santri)
            ->whereHas('santriTahfidz', function ($query) use ($id_tahfidz) {
                $query->where('id_tahfidz', $id_tahfidz);
            })
            ->first();
    
        if (!$santri) {
            return redirect()->back()->withErrors(['id_santri' => 'Santri tidak ditemukan dalam kelompok tahfidz ini.']);
        }
    
        // Cek jika hafalan untuk santri ini di bulan dan tahun yang sama sudah ada
        $existingHafalan = Hafalan::where('id_santri', $request->id_santri)
            ->where('bulan', $request->bulan)
            ->where('tahun', $request->tahun)
            ->first();
    
        if ($existingHafalan) {
            return redirect()->back()->withErrors(['id_santri' => 'Hafalan untuk santri ini pada bulan yang sama sudah ada.']);
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
    
        return redirect()->route('admin.hafalan.hafalan', $id_tahfidz)->with('success', 'Hafalan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $hafalan = Hafalan::findOrFail($id);
        $santris = Santri::whereHas('santriTahfidz', function ($query) use ($hafalan) {
            $query->where('id_tahfidz', $hafalan->id_tahfidz);
        })->get(); // Filter santri sesuai kelompok tahfidz
        return view('admin.hafalan.edit', compact('hafalan', 'santris'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'santri_id' => 'required',
            'ayat' => 'required',
            'surat' => 'required',
            'juz' => 'required',
            'bulan' => 'required',
            'tahun' => 'required',
        ]);

        $hafalan = Hafalan::findOrFail($id);
        $hafalan->update($request->all());

        return redirect()->route('admin.hafalan.hafalan', $hafalan->id_tahfidz)->with('success', 'Hafalan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $hafalan = Hafalan::findOrFail($id);
        $hafalan->delete();

        return redirect()->route('admin.hafalan.hafalan', $hafalan->id_tahfidz)->with('success', 'Hafalan berhasil dihapus!');
    }
}
