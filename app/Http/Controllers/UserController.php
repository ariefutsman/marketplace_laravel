<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;    

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('pages.user.index', compact('users'));
    }

    /**
     * Update user role
     */
    public function updateRole(Request $request, $id)
    {
        // Validasi input - menggunakan admin dan customer
        $request->validate([
            'role' => 'required|in:admin,customer',
        ]);

        // Cari user
        $user = User::findOrFail($id);

        // Cegah admin mengubah role sendiri
        if ($user->id == auth()->id()) {
            return redirect()->back()->with('error', 'Anda tidak dapat mengubah role sendiri!');
        }

        // Update role user
        $user->update([
            'role' => $request->role
        ]);

        return redirect()->back()->with('success', 'Role user berhasil diubah menjadi ' . ucfirst($request->role));
    }
}