<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\murobby;  // Model murobby
use App\Models\pegawai;  // Model pegawai

class MurobbyController extends Controller
{
    // Menampilkan daftar murobby
    public function index()
    {
        // Mengambil data murobby dan relasi pegawai
        $murobbies = murobby::with('pegawai')->get();
        return view('admin.murobby.index', compact('murobbies'));
    }

    // Menampilkan form untuk menambah murobby
    public function create()
    {
        // Ambil pegawai yang memiliki jabatan 'murobby' dan belum terdaftar di tabel murobby
        $pegawais = Pegawai::where('jabatan', 'murobby')
                           ->whereNotIn('id_pegawai', Murobby::pluck('id_pegawai'))
                           ->get();
    
        return view('admin.murobby.form', compact('pegawais'));
    }

    // Menyimpan data murobby baru
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'id_pegawai' => 'required|exists:pegawai,id_pegawai',
            'nama_kamar' => 'required|string|max:255',
        ]);

        // Membuat murobby baru
        murobby::create([
            'id_pegawai' => $validated['id_pegawai'],
            'nama_kamar' => $validated['nama_kamar'],
        ]);

        return redirect()->route('admin.murobby.index')
            ->with('success', 'Murobby berhasil ditambahkan!');
    }

    // Menampilkan form untuk mengedit data murobby
    public function edit($id_murobby)
    {
        // Ambil data murobby yang ingin diedit
        $murobbies = murobby::findOrFail($id_murobby);
    
        // Ambil pegawai yang memiliki jabatan 'murobby' dan belum terdaftar di tabel murobby
        $pegawais = pegawai::where('jabatan', 'murobby')
                           ->whereNotIn('id_pegawai', murobby::pluck('id_pegawai'))
                           ->get();
    
        return view('admin.murobby.edit', compact('murobbies', 'pegawais'));
    }

    // Menyimpan perubahan data murobby
    public function update(Request $request, $id_murobby)
    {
        // Validasi input
        $validated = $request->validate([
            'id_pegawai' => 'required|exists:pegawai,id_pegawai',
            'nama_kamar' => 'required|string|max:255',
        ]);

        // Mencari murobby untuk diupdate
        $murobby = murobby::findOrFail($id_murobby);

        // Update data murobby
        $murobby->update([
            'id_pegawai' => $validated['id_pegawai'],
            'nama_kamar' => $validated['nama_kamar'],
        ]);

        return redirect()->route('admin.murobby.index')
            ->with('success', 'Murobby berhasil diperbarui!');
    }

    // Menghapus murobby
    public function destroy($id_murobby)
    {
        // Mencari murobby untuk dihapus
        $murobby = murobby::findOrFail($id_murobby);
        $murobby->delete();

        return redirect()->route('admin.murobby.index')
            ->with('success', 'Murobby berhasil dihapus!');
    }
}
