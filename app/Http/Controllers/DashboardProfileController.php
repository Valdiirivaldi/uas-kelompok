<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DashboardProfileController extends Controller
{
    public function index()
    {
        return view('dashboard.profile.index', [
            'user' => auth()->user()
        ]);
    }

    public function update(Request $request)
{
    $user = auth()->user();
    
    $rules = [
        'name' => 'required|max:255',
        'username' => 'required|min:3|max:255|unique:users,username,' . $user->id,
        'email' => 'required|email:dns|unique:users,email,' . $user->id,
        'image' => 'image|file|max:1024' // Validasi gambar max 1MB
    ];

    $validatedData = $request->validate($rules);

    // Logika Upload Gambar
    if ($request->file('image')) {
        // Hapus foto lama jika ada dan bukan avatar default
        if ($user->image) {
            Storage::delete($user->image);
        }
        $validatedData['image'] = $request->file('image')->store('user-images');
    }

    if ($request->filled('password')) {
        $validatedData['password'] = Hash::make($request->password);
    }

    User::where('id', $user->id)->update($validatedData);

    return redirect('/dashboard/profile')->with('success', 'Profil dan foto berhasil diperbarui!');
}
}