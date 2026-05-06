<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    public function index() {
        return view('pages.auth.register');
    }

    public function register(RegisterRequest $request) {
        $validated = $request->validated();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => 'customer', // Default pendaftar baru adalah pembeli
        ]);

        Auth::login($user);
        return redirect()->route('home-page');
    }
}
