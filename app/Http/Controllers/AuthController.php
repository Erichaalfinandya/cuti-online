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

        // Log isi credentials
        Log::info('Data login attempt:', $credentials);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            Log::info('Login berhasil untuk NIP: ' . $credentials['nip']);
            return redirect()->intended('/dashboard');
        }

        Log::warning('Login gagal untuk NIP: ' . $credentials['nip']);
        return back()->withErrors([
            'nip' => 'NIP atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
