<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'nip' => 'required',
            'password' => 'required',
        ]);

        Log::info('Data login attempt:', $credentials);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            Log::info('Login berhasil untuk NIP: ' . $credentials['nip']);

            return response()->json([
                'status' => 'success',
                'message' => 'Login berhasil.',
                'redirect' => url('/dashboard'),
            ]);
        }

        Log::warning('Login gagal untuk NIP: ' . $credentials['nip']);

        return response()->json([
            'status' => 'error',
            'message' => 'NIP atau password salah.',
        ], 401);
    }

    public function logout(Request $request)
    {
        if (Auth::check()) {
            Auth::logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'status' => 'success',
            'message' => 'Logout berhasil.',
            'redirect' => url('/'),
        ]);
    }
}
