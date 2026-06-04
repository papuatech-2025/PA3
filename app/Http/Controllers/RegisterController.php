<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class RegisterController extends Controller
{
    /**
     * Tampilkan halaman register
     */
    public function register()
    {
        return view('Register.register');
    }

    /**
     * Proses register user baru
     */
    public function actionregister(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'username' => 'required|min:3|max:50',
            'password' => 'required|min:6|confirmed',
        ]);

        // Simpan user dan langsung aktif
        User::create([
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'user',
            'active' => 1,
            'email_verified_at' => now(),
        ]);

        // Notifikasi berhasil
        Session::flash('success', 'Registrasi berhasil. Silakan login.');

        return redirect('/login');
    }
}