<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hafalan;
use App\Models\santri;
use App\Models\tahfidz;
use App\Models\pegawai;
use Carbon\Carbon;

class HafalanController extends Controller
{
    // Menampilkan daftar hafalan santri
    public function hafalan($id_tahfidz, Request $request)
    {
        // Mendapatkan tahfidz berdasarkan id
        $tahfidz = Tahfidz::findOrFail($id_tahfidz);

        // Mendapatkan bulan dan tahun dari request atau gunakan bulan dan tahun saat ini
        $selectedBulan = $request->input('bulan', Carbon::now()->format('m'));
        $selectedTahun = $request->input('tahun', Carbon::now()->format('Y'));

        // Mendapatkan daftar hafalan berdasarkan id tahfidz, bulan, dan tahun yang dipilih
        $hafalans = Hafalan::where('id_tahfidz', $id_tahfidz)
            ->where('bulan', $selectedBulan)
            ->where('tahun', $selectedTahun)
            ->with('santri')
            ->get();

        // Menampilkan view hafalan dengan data tahfidz, hafalan, bulan, dan tahun yang dipilih
        return view('admin.hafalan.hafalan', compact('tahfidz', 'hafalans', 'selectedBulan', 'selectedTahun'));
    }
    public function index()
    {
        $tahfidzs = tahfidz::all();
        return view('admin.hafalan.index', compact('tahfidzs'));
    }
    // public function index($id_santri)
    // {
    //     // Mengambil hafalan santri
    //     $hafalan = Hafalan::where('id_santri', $id_santri)
    //         ->with('santri', 'tahfidz')
    //         ->get();
        
    //     // Mengambil data santri
    //     $Santri = Santri::findOrFail($id_santri);

    //     return view('admin.hafalan.index', compact('hafalan', 'Santri'));
    // }

    public function form($id_tahfidz)
    {
        $tahfidz = Tahfidz::findOrFail($id_tahfidz);
        $santris = Santri::all(); // Ambil semua santri untuk dropdown pilihan
        return view('admin.hafalan.form', compact('tahfidz', 'santris'));
    }

    // Menyimpan data hafalan santri
    public function store(Request $request, $id_tahfidz)
    {
        $request->validate([
            'santri_id' => 'required',
            'ayat' => 'required',
            'surat' => 'required',
            'juz' => 'required',
            'bulan' => 'required',
            'tahun' => 'required',
        ]);
    
        // Cek jika hafalan untuk santri ini di bulan dan tahun yang sama sudah ada
        $existingHafalan = Hafalan::where('santri_id', $request->santri_id)
            ->where('bulan', $request->bulan)
            ->where('tahun', $request->tahun)
            ->first();
    
        if ($existingHafalan) {
            return redirect()->back()->withErrors(['santri_id' => 'Hafalan untuk santri ini pada bulan yang sama sudah ada.']);
        }
    
        // Jika tidak ada, simpan hafalan baru
        Hafalan::create([
            'santri_id' => $request->santri_id,
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
        $santris = Santri::all(); // Ambil semua santri
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