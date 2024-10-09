<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\santri;

class SantriController extends Controller
{
    // Menampilkan daftar santri
    public function index()
    {
        $santris = Santri::all();
        return view('admin.santri.index', compact('santris'));
    }

    // Menampilkan form untuk menambah santri
    public function form()
    {
        return view('admin.santri.form');
    }

    // Menyimpan data santri baru
    public function store(Request $request)
    {
        $request->validate([
        'no_induk' => 'required|unique:santri,no_induk',
        'nama_santri' => 'required|string|max:255',
        'nik' => 'required|unique:santri,nik',
        'tempat_lahir' => 'required|string|max:255',
        'tgl_lahir' => 'required|date',
        'jenis_kelamin' => 'required|in:L,P',
        'alamat' => 'required|string',
        'provinsi' => 'required|string',
        'kota' => 'required|string',
        'kecamatan' => 'required|string',
        'kelurahan' => 'required|string',
        'kode_pos' => 'required|string',
        'status_santri' => 'required|in:aktif,alumni',
        'nama_ayah' => 'required|string',
        'nama_ibu' => 'required|string',
        ]);

        Santri::create($request->all());

        return redirect()->route('admin.santri.index')->with('success', 'Santri berhasil ditambahkan');
    }

    // Menampilkan form edit santri
    public function edit(Santri $santri)
    {
        return view('admin.santri.edit', compact('santri'));
    }

    // Menyimpan perubahan data santri
    public function update(Request $request, Santri $santri)
    {
        $request->validate([
            'no_induk' => 'required|unique:santri,no_induk,' . $santri->id_santri . ',id_santri',
            'nama_santri' => 'required|string|max:255',
            'nik' => 'required|string|max:16|unique:santri,nik,' . $santri->id_santri . ',id_santri',
            'nisn' => 'nullable|string|max:16|unique:santri,nisn,' . $santri->id_santri . ',id_santri', // NISN opsional
            'anak_ke' => 'nullable|integer', // Anak ke opsional
            'tempat_lahir' => 'required|string|max:255',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string',
            'provinsi' => 'required|string',
            'kota' => 'required|string',
            'kecamatan' => 'required|string',
            'kelurahan' => 'required|string',
            'kode_pos' => 'required|string',
            'no_hp' => 'nullable|string|max:15', // No HP opsional
            'status_santri' => 'required|in:aktif,alumni',
            'no_kk' => 'nullable|string|max:16', // Nomor Kartu Keluarga opsional
            'nama_ayah' => 'required|string',
            'pendidikan_ayah' => 'nullable|string|max:255', // Pendidikan Ayah opsional
            'pekerjaan_ayah' => 'nullable|string|max:255', // Pekerjaan Ayah opsional
            'nama_ibu' => 'required|string',
            'pendidikan_ibu' => 'nullable|string|max:255', // Pendidikan Ibu opsional
            'pekerjaan_ibu' => 'nullable|string|max:255', // Pekerjaan Ibu opsional
        ]);
    
        $santri->update($request->all());
    
        return redirect()->route('admin.santri.index')->with('success', 'Data santri berhasil diperbarui');
    }
    
}
