<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionsController extends Controller
{
    public function create()
    {
        return view('session.login-session');
    }

    public function store()
    {
        $attributes = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($attributes)) {
            session()->regenerate();

            // Ambil pengguna yang sudah login
            $user = Auth::user();

            // Mengecek role dan mengarahkan pengguna sesuai dengan role
            switch ($user->role) {
                case 'admin':
                    return redirect()->route('dashboard')->with(['success' => 'You are logged in as Admin.']);
                case 'tahfidz':
                    return redirect()->route('tahfidz.dashboard')->with(['success' => 'You are logged in as Tahfidz.']);
                case 'murobby':
                    return redirect()->route('murobby.dashboard')->with(['success' => 'You are logged in as Murobby.']);
                case 'walsan':
                    return redirect()->route('santri.dashboard')->with(['success' => 'You are logged in as Walsan.']);
                default:
                    // Jika role tidak cocok atau tidak ada, logout pengguna
                    Auth::logout();
                    return redirect('/login')->withErrors(['role' => 'Your role is not recognized. You have been logged out.']);
            }
        } else {
            return back()->withErrors(['email' => 'Email or password invalid.']);
        }
    }

    public function destroy(Request $request)
    {
        Auth::logout(); // Logout pengguna
        return redirect('/login')->with('success', 'Anda telah logout.');
    }
}
