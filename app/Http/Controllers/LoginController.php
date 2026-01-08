<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
    // 1. Simpan hasil validasi ke dalam variabel $credentials
    $credentials = $request->validate([
        'email' => 'required|email:dns',
        'password' => 'required'
    ]);

    // 2. Sekarang $credentials sudah berisi array ['email' => '...', 'password' => '...']
    if(Auth::attempt($credentials)) {
        $request->session()->regenerate();

        return redirect()->intended('/dashboard');
    }

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