<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tahfidz; // Model 'tahfidz'
use App\Models\pegawai; // Model 'pegawai'

class TahfidzController extends Controller
{
    // Menampilkan daftar tahfidz
    public function index()
    {
        $tahfidzs = tahfidz::all();
        return view('admin.tahfidz.index', compact('tahfidzs'));
    }

    public function form()
    {
        $pegawais = pegawai::where('jabatan', 'tahfidz')->get(); // Retrieve only pegawai with jabatan 'tahfidz'
        return view('admin.tahfidz.form', compact('pegawais')); // Pass the pegawais to the view
    }



    // Menyimpan data tahfidz baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_tahfidz' => 'required|string|max:255',
            'id_pegawai' => 'required|exists:pegawai,id_pegawai', // Pastikan id_pegawai ada di tabel pegawai
        ]);

        // Cek jabatan pegawai
        $pegawais = pegawai::find($request->id_pegawai);
        if ($pegawais->jabatan !== 'tahfidz') {
            return redirect()->back()->withErrors(['jabatan' => 'Pegawai yang dimasukkan bukan ustadz tahfidz.']);
        }

        tahfidz::create($request->all());

        return redirect()->route('admin.tahfidz.index')->with('success', 'Tahfidz berhasil ditambahkan');
    }

    // Menampilkan form edit tahfidz// Menampilkan form edit tahfidz
    public function edit(tahfidz $tahfidz)
    {
        $pegawais = pegawai::where('jabatan', 'tahfidz')->get(); // Retrieve only pegawai with jabatan 'tahfidz'
        return view('admin.tahfidz.edit', compact('tahfidz', 'pegawais')); // Pass both tahfidz and pegawais to the view
    }


    // Menyimpan perubahan data tahfidz
    public function update(Request $request, tahfidz $tahfidz)
    {
        $request->validate([
            'nama_tahfidz' => 'required|string|max:255',
            'id_pegawai' => 'required|exists:pegawai,id_pegawai', // Pastikan id_pegawai ada di tabel pegawai
        ]);

        // Cek jabatan pegawai
        $pegawais = pegawai::find($request->id_pegawai);
        if ($pegawais->jabatan !== 'tahfidz') {
            return redirect()->back()->withErrors(['jabatan' => 'Pegawai yang dimasukkan bukan ustadz tahfidz.']);
        }

        $tahfidz->update($request->all());

        return redirect()->route('admin.tahfidz.index')->with('success', 'Data tahfidz berhasil diperbarui');
    }

    // Menghapus tahfidz
    public function destroy(tahfidz $tahfidz)
    {
        $tahfidz->delete();

        return redirect()->route('admin.tahfidz.index')->with('success', 'Data tahfidz berhasil dihapus');
    }
}
