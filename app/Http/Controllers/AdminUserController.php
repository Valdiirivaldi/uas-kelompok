<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        return view('dashboard.users.index', [
            // Tampilkan semua user kecuali diri sendiri
            'users' => User::where('id', '!=', auth()->user()->id)->get()
        ]);
    }

    public function destroy(User $user)
    {
        User::destroy($user->id);
        return redirect('/dashboard/users')->with('success', 'User has been deleted!');
    }
    public function update(Request $request, User $user)
{
    // Cek jika user yang diedit adalah dirinya sendiri, cegah agar tidak turun jabatan sendiri
    if($user->id === auth()->user()->id) {
        return redirect('/dashboard/users')->with('error', 'You cannot change your own role!');
    }

    // Toggle role: jika 1 jadi 0, jika 0 jadi 1
    $newRole = $user->is_admin ? 0 : 1;
    
    User::where('id', $user->id)->update(['is_admin' => $newRole]);

    return redirect('/dashboard/users')->with('success', 'User role has been updated!');
}
}