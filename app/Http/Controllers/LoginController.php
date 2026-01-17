<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index', [
            'title' => 'Login',
            'active' => 'login'
        ]);
    }

    public function authenticate(Request $request)
    {
        // 1. Validasi Input
        $credentials = $request->validate([
            // Jika develop offline (tanpa internet), hapus ':dns' agar tidak error
            'email' => 'required|email:dns', 
            'password' => 'required'
        ]);

        // 2. Coba Login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // [REVISI PENTING] 
            // Paksa redirect ke dashboard secara langsung
            return redirect('/dashboard');
        }

        // 3. Jika Gagal
        return back()->with('loginError', 'Login Gagal! Silakan cek kembali email dan password Anda.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}