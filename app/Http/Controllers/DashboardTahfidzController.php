<?php

namespace App\Http\Controllers;

use App\Models\tahfidz;
use Illuminate\Http\Request;

class DashboardTahfidzController extends Controller
{
    // Menampilkan dashboard tahfidz
    public function index()
    {
        // Ambil semua data tahfidz untuk ditampilkan di dashboard
        $tahfidz = Tahfidz::with('pegawai')->get(); // Asumsi ada relasi dengan pegawai
        return view('tahfidz.dashboard', compact('tahfidz'));
    }

    // Menampilkan form untuk menambah data tahfidz
    public function create()
    {
        return view('dashboard.tahfidz.create');
    }

    // Menyimpan data tahfidz baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_tahfidz' => 'required|string|max:255',
            'id_pegawai' => 'required|exists:pegawai,id_pegawai',
            // Validasi lain sesuai kebutuhan
        ]);

        Tahfidz::create($request->all());

        return redirect()->route('tahfidz.index')->with('success', 'Data tahfidz berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit data tahfidz
    public function edit($id)
    {
        $tahfidz = Tahfidz::findOrFail($id);
        return view('dashboard.tahfidz.edit', compact('tahfidz'));
    }

    // Memperbarui data tahfidz
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_tahfidz' => 'required|string|max:255',
            'id_pegawai' => 'required|exists:pegawai,id_pegawai',
            // Validasi lain sesuai kebutuhan
        ]);

        $tahfidz = Tahfidz::findOrFail($id);
        $tahfidz->update($request->all());

        return redirect()->route('tahfidz.index')->with('success', 'Data tahfidz berhasil diperbarui.');
    }

    // Menghapus data tahfidz
    public function destroy($id)
    {
        $tahfidz = Tahfidz::findOrFail($id);
        $tahfidz->delete();

        return redirect()->route('tahfidz.index')->with('success', 'Data tahfidz berhasil dihapus.');
    }
}
