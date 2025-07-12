<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function form()
    {
        return view('layouts.login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Arahkan berdasarkan role
            $user = Auth::user();
            if ($user->role === 'dokter') {
                return redirect()->intended('/obat');
            } elseif ($user->role === 'pasien') {
                return redirect()->intended('/dokter');
            } elseif ($user->role === 'admin') {
                return redirect()->intended('/iniadmin');
            }

            // Default fallback
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Email atau Password yang anda masukan salah!',
            
        ])->onlyInput('email');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
