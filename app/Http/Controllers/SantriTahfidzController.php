<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\santri;
use App\Models\tahfidz;
use App\Models\Santri_Tahfidz; // Nama model disesuaikan dengan casing dan nama file

class SantriTahfidzController extends Controller
{
    // Menampilkan daftar kelompok tahfidz
    public function indexTahfidz()
    {
        $tahfidzs = tahfidz::with('pegawai')->get(); // Pastikan relasi 'pegawai' di model Tahfidz sudah benar
        return view('admin.tahfidz.index', compact('tahfidzs'));
    }

    // Menampilkan daftar santri dalam kelompok tahfidz tertentu
    public function indexSantri($id_tahfidz)
    {
        $tahfidz = tahfidz::findOrFail($id_tahfidz);
        $santris = Santri_Tahfidz::with('santri')
            ->where('id_tahfidz', $id_tahfidz)
            ->get();
            

        
        return view('admin.santri_tahfidz.indexSantri', compact('tahfidz', 'santris'));
    }

    // Menampilkan form untuk menambah santri ke kelompok tahfidz
    public function form($id_tahfidz)
    {
        $tahfidz = Tahfidz::findOrFail($id_tahfidz);
    
        // Mengambil santri yang belum terdaftar dalam kelompok tahfidz manapun
        $santris = Santri::whereDoesntHave('santriTahfidz')->get();
    
        return view('admin.santri_tahfidz.form', compact('tahfidz', 'santris'));
    }
    

    // Menyimpan data santri ke kelompok tahfidz
    public function store(Request $request, $id_tahfidz)
    {
        $validated = $request->validate([
            'id_santri' => 'required|exists:santri,id_santri',
        ]);
    
        // Untuk update data
        if ($request->isMethod('put')) {
            // Lakukan update data di sini
            $santriTahfidz = Santri_Tahfidz::where('id_tahfidz', $id_tahfidz)
                                          ->where('id_santri', $validated['id_santri'])
                                          ->first();
    
            // Pastikan data ditemukan sebelum diupdate
            if ($santriTahfidz) {
                $santriTahfidz->id_santri = $validated['id_santri'];
                $santriTahfidz->save();
            }
    
            return redirect()->route('admin.santri_tahfidz.indexSantri', $id_tahfidz)->with('success', 'Santri berhasil diperbarui!');
        }
    
        // Untuk create data
        Santri_Tahfidz::create([
            'id_santri' => $validated['id_santri'],
            'id_tahfidz' => $id_tahfidz,
        ]);
    
        return redirect()->route('admin.santri_tahfidz.indexSantri', $id_tahfidz)->with('success', 'Santri berhasil ditambahkan!');
    }

    public function edit($id_tahfidz, $id_santri_tahfidz)
{
    $tahfidz = Tahfidz::findOrFail($id_tahfidz);
    $santriTahfidz = Santri_Tahfidz::where('id_tahfidz', $id_tahfidz)
                                  ->where('id_santri', $id_santri_tahfidz)
                                  ->firstOrFail();

                                  $santris = Santri::whereDoesntHave('santriTahfidz')->get();

    return view('admin.santri_tahfidz.edit', compact('tahfidz', 'santriTahfidz', 'santris'));
}

public function update(Request $request, $id_tahfidz, $id)
{
    // Validasi input
    $validated = $request->validate([
        'id_santri' => 'required|exists:santri,id_santri',
    ]);

    // Cari data santri tahfidz
    $santriTahfidz = Santri_Tahfidz::findOrFail($id);

    // Update data santri tahfidz
    $santriTahfidz->id_santri = $validated['id_santri'];
    $santriTahfidz->save();

    // Redirect kembali dengan pesan sukses
    return redirect()->route('admin.santri_tahfidz.indexSantri', $id_tahfidz)
                     ->with('success', 'Santri berhasil diperbarui.');
}


    

    // Menghapus santri dari kelompok tahfidz
    public function destroy($id_tahfidz, $id_santri)
    {
        // Menemukan data yang ingin dihapus berdasarkan $id_santri
        $santriTahfidz = Santri_Tahfidz::where('id_tahfidz', $id_tahfidz)
                                        ->where('id_santri', $id_santri)
                                        ->firstOrFail();
    
        $santriTahfidz->delete();
    
        // Mengarahkan kembali setelah penghapusan
        return redirect()
            ->route('admin.santri_tahfidz.indexSantri', $id_tahfidz)
            ->with('success', 'Santri berhasil dihapus dari kelompok tahfidz.');
    }
    
}
