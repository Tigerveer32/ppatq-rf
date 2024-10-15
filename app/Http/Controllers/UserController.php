<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\pegawai;
use App\Models\santri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $Pegawai = pegawai::all();
        $santris = santri::all();
        return view('admin.users.index', compact('users', 'Pegawai', 'santris'));
    }

    

    public function form()
    {
        $Pegawai = pegawai::all();
        $santris = santri::all();
        return view('admin.users.form', compact('Pegawai', 'santris'));
    }

    public function store(Request $request)
{
    // Validasi data
    $validatedData = $request->validate([
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed',
        'phone' => 'nullable|string',
        'location' => 'nullable|string',
        'about_me' => 'nullable|string',
        'role' => 'required|in:admin,pembina,tahfidz,murobby,walsan',
        'pegawai_id' => 'nullable|exists:pegawai,id_pegawai', // Perbaiki nama kolom
        'santri_id' => 'nullable|exists:santri,id_santri', // Perbaiki nama kolom
    ]);

    // Ambil nama berdasarkan role
    if ($request->role === 'walsan' && $request->santri_id) {
        $santri = Santri::find($request->santri_id);
        $validatedData['name'] = $santri ? $santri->nama_santri : null; // Ambil nama santri
    } elseif (in_array($request->role, ['admin', 'pembina', 'tahfidz', 'murobby']) && $request->pegawai_id) {
        $pegawai = Pegawai::find($request->pegawai_id);
        $validatedData['name'] = $pegawai ? $pegawai->nama_pegawai : null; // Ambil nama pegawai
    }

    // Cek apakah name sudah terisi
    if (!isset($validatedData['name'])) {
        return back()->withErrors(['name' => 'Nama tidak dapat ditemukan.']);
    }

    // Simpan user
    User::create([
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        'password' => bcrypt($validatedData['password']),
        'phone' => $request->phone,
        'location' => $request->location,
        'about_me' => $request->about_me,
        'role' => $validatedData['role'],
        'pegawai_id' => $request->pegawai_id,
        'santri_id' => $request->santri_id,
    ]);

    return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan.');
}


    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|string',
        ]);

        $user->update($request->only('name', 'email', 'role')); // Update data pengguna

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete(); // Hapus pengguna

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}
