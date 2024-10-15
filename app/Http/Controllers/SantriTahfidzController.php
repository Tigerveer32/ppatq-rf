<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\santri;
use App\Models\tahfidz;
use App\Models\pegawai;
use App\Models\Santri_Tahfidz;

class SantriTahfidzController extends Controller
{
    // Menampilkan daftar santri tahfidz
    public function index($id_tahfidz)
    {
        // Mengambil santri yang tergabung dalam kelompok tahfidz tertentu
        $santriTahfidz = Santri_Tahfidz::where('id_tahfidz', $id_tahfidz)
            ->with('santri', 'pegawai', 'tahfidz')
            ->get();
        
        // Mengambil data tahfidz dan pegawai (ustadz)
        $Tahfidz = tahfidz::findOrFail($id_tahfidz);
        $Ustadz = pegawai::where('id_pegawai', $Tahfidz->id_pegawai)->first();

        return view('admin.santri_tahfidz.index', compact('santriTahfidz', 'Tahfidz', 'Ustadz'));
    }

    // Menampilkan form untuk menambah santri tahfidz
    public function form($id_tahfidz)
    {
        $Tahfidz = tahfidz::findOrFail($id_tahfidz);
        $santris = santri::whereDoesntHave('santriTahfidz', function ($query) use ($id_tahfidz) {
            $query->where('id_tahfidz', $id_tahfidz);
        })->get();
        
        return view('admin.santri_tahfidz.form', compact('Tahfidz', 'santris'));
    }

    // Menyimpan data santri tahfidz
    public function store(Request $request, $id_tahfidz)
    {
        $request->validate([
            'id_santri' => 'required|exists:santri,id_santri',
        ]);

        $tahfidz = Tahfidz::findOrFail($id_tahfidz);
        $santri = Santri::findOrFail($request->id_santri);

        Santri_Tahfidz::create([
            'id_santri' => $santri->id_santri,
            'id_tahfidz' => $tahfidz->id_tahfidz,
            'id_pegawai' => $tahfidz->id_pegawai,
        ]);

        return redirect()->route('admin.santri_tahfidz.index', $id_tahfidz)->with('success', 'Santri berhasil ditambahkan ke kelompok tahfidz.');
    }

    // Menghapus santri dari kelompok tahfidz
    public function destroy($id_tahfidz, $id_santri_tahfidz)
    {
        $santriTahfidz = Santri_Tahfidz::findOrFail($id_santri_tahfidz);
        $santriTahfidz->delete();

        return redirect()->route('admin.santri_tahfidz.index', $id_tahfidz)->with('success', 'Santri berhasil dihapus dari kelompok tahfidz.');
    }
}
