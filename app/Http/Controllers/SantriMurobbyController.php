<?php

namespace App\Http\Controllers;

use App\Models\SantriMurobby;
use App\Models\santri;  
use App\Models\murobby;  
use Illuminate\Http\Request;

class SantriMurobbyController extends Controller
{
    // Menampilkan data santri yang bisa dipilih untuk murobby
    public function create($id_murobby)
    {
        $murobby = murobby::findOrFail($id_murobby);
        // Ambil semua santri yang belum terdaftar di tabel santri_murobby
        $santris = santri::whereDoesntHave('SantriMurobby')->get(); // Gunakan model santri dengan huruf kecil

        return view('admin.santri_murobby.form', compact('santris', 'murobby'));
    }

    // Menyimpan data santri dan murobby
    public function store(Request $request, $id_murobby)
    {
        // Validasi input
        $validated = $request->validate([
            'id_santri' => 'required|exists:santri,id_santri',
        ]);

        // Menyimpan data ke tabel santri_murobby
        SantriMurobby::create([
            'id_santri' => $validated['id_santri'],
            'id_murobby' => $id_murobby,
            
        ]);

        return redirect()->route('admin.santri_murobby.indexSantri',$id_murobby)->with('success', 'Santri berhasil ditambahkan ke kelompok Murobby.');
    }

    // Menampilkan daftar santri yang sudah terdaftar di kelompok murobby
    public function indexSantri($id_murobby)
    {
        // Fetch the murobby data
        $murobby = Murobby::findOrFail($id_murobby);
    
        // Fetch the list of santris in the given murobby
        $santris = SantriMurobby::with('santri')  // Eager load the 'santri' relationship
                                ->where('id_murobby', $id_murobby)
                                ->get();
    
        // Return the view with the necessary data
        return view('admin.santri_murobby.indexSantri', compact('murobby', 'santris'));
    }
    
    
    public function edit($id_murobby, $id_santri)
    {
        // Fetch the murobby and the specific santriMurobby record based on the santri's id
        $murobby = murobby::findOrFail($id_murobby);
        $santriMurobby = santriMurobby::where('id_murobby', $id_murobby)
                                      ->where('id_santri', $id_santri)
                                      ->firstOrFail();

        // Get the available santris (optional, if you want to allow changing the santri)
        $santris = santri::whereDoesntHave('SantriMurobby')->get(); 

        // Pass data to the edit view
        return view('admin.santri_murobby.edit', compact('murobby', 'santriMurobby', 'santris'));
    }

    // Menyimpan perubahan data santri yang terdaftar di kelompok murobby
    public function update(Request $request, $id_murobby, $id_santri)
    {
        // Validasi input
        $validated = $request->validate([
            'id_santri' => 'required|exists:santri,id_santri',  // Make sure 'santri' is used in lowercase
        ]);

        // Fetch the specific santriMurobby record to update
        $santriMurobby = santriMurobby::where('id_murobby', $id_murobby)
                                      ->where('id_santri', $id_santri)
                                      ->firstOrFail();

        // Update the santriMurobby record
        $santriMurobby->update([
            'id_santri' => $validated['id_santri'],
            'id_murobby' => $id_murobby,
        ]);

        // Redirect back with success message
        return redirect()->route('admin.santri_murobby.indexSantri', $id_murobby)->with('success', 'Data santri berhasil diperbarui.');
    }
    // Menghapus data dari tabel santri_murobby
    public function destroy($id_murobby, $id_santri)
    {
        $santriMurobby = SantriMurobby::where('id_murobby', $id_murobby)
                                      ->where('id_santri', $id_santri)
                                      ->firstOrFail();
        $santriMurobby->delete();

        return redirect()->route('admin.santri_murobby.indexSantri',$id_murobby)->with('success', 'Santri berhasil dihapus dari daftar kelompok murobby.');
    }
}
