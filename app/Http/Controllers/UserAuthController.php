<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserAuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check() && Auth::user()->role === 'user') {
            return redirect()->route('laporan.create');
        }

        return view('auth.user.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials, $request->has('remember'))) {

            $user = Auth::user();

            // Pastikan hanya user biasa yang login di halaman user
            if ($user->role !== 'user') {
                Auth::logout();

                return back()->with(
                    'error',
                    'Akun Anda adalah Admin. Silakan login melalui halaman admin.'
                );
            }

            $request->session()->regenerate();

            return redirect()->intended(route('laporan.create'));
        }

        return back()
            ->withErrors([
                'email' => 'Email atau password salah.'
            ])
            ->onlyInput('email');
    }

    public function showRegister()
    {
        return view('auth.user.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|min:3|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
            'active' => 1,
            'email_verified_at' => now(),
        ]);

        return redirect()
            ->route('user.login')
            ->with('success', 'Registrasi berhasil! Silakan login.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('branda');
    }
}