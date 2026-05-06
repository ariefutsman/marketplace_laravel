<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users',
            'password'  => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'data'         => $user,
            'access_token' => $token,
            'token_type'   => 'Bearer',
        ]);
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::make($request->password, ['fallback' => $user->password])) {
            return response()->json([
                'message' => 'Email atau Password salah'
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message'      => 'Login sukses',
            'access_token' => $token,
            'token_type'   => 'Bearer',
            'user'         => $user
        ]);
    }
}