<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return view('auth.admin.login');
    }

    public function login(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // 2. Cari User berdasarkan Email
        $user = User::where('email', $request->email)->first();

        // 3. Cek apakah Email terdaftar
        if (!$user) {
            return back()->withErrors([
                'email' => 'Email tidak terdaftar dalam sistem kami.'
            ])->withInput($request->only('email'));
        }

        // 4. Cek apakah User tersebut adalah Admin
        if ($user->role !== 'admin') {
            return back()->withErrors([
                'email' => 'Akses ditolak! Akun ini bukan merupakan Admin.'
            ])->withInput($request->only('email'));
        }

        // 5. Cek apakah Password benar
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'password' => 'Password yang Anda masukkan salah.'
            ])->withInput($request->only('email'));
        }

        // 6. Jika semua lolos, lakukan Login
        if (Auth::attempt($request->only('email', 'password'), $request->has('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors(['email' => 'Terjadi kesalahan sistem.'])->withInput();
    }

    public function showRegister()
    {
        return view('auth.admin.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|min:3|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'secret_code' => 'required|in:ADMIN123',
        ]);

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
            'active' => 1,
            'email_verified_at' => now(),
            'verify_key' => null,
        ]);

        return redirect()
            ->route('admin.login')
            ->with('success', 'Registrasi Admin berhasil! Silakan login.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('branda');
    }
}