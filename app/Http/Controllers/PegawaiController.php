<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pegawai; // Menggunakan model Pegawai

class PegawaiController extends Controller
{
    // Menampilkan daftar pegawai
    public function index()
    {
        $pegawais = pegawai::all(); // Mengambil semua data pegawai
        return view('admin.pegawai.index', compact('pegawais'));
    }

    // Menampilkan form untuk menambah pegawai
    public function form()
    {
        return view('admin.pegawai.form');
    }

    // Menyimpan data pegawai baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_pegawai' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'jabatan' => 'required|in:murobby,tahfidz,pembina',
            'alamat' => 'required|string',
            'pendidikan_terakhir' => 'nullable|string|max:255',
        ]);

        Pegawai::create($request->all()); // Menyimpan data pegawai

        return redirect()->route('admin.pegawai.index')->with('success', 'Pegawai berhasil ditambahkan');
    }

    // Menampilkan form edit pegawai
    public function edit(Pegawai $pegawai)
    {
        return view('admin.pegawai.edit', compact('pegawai'));
    }

    // Menyimpan perubahan data pegawai
    public function update(Request $request, Pegawai $pegawai)
    {
        $request->validate([
            'nama_pegawai' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'jabatan' => 'required|in:murobby,tahfidz,pembina',
            'alamat' => 'required|string',
            'pendidikan_terakhir' => 'nullable|string|max:255',
        ]);

        $pegawai->update($request->all()); // Mengupdate data pegawai

        return redirect()->route('admin.pegawai.index')->with('success', 'Data pegawai berhasil diperbarui');
    }
}
