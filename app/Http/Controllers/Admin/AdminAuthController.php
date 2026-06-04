<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\User;
use App\Mail\MailSend;

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
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

if (Auth::guard('web')->attempt($credentials, $request->has('remember'))) {
            $user = Auth::user();
            
            if ($user->role !== 'admin') {
                Auth::logout();
                return back()->with('error', 'Akses ditolak! Ini halaman khusus Admin.');
            }
            
            if ($user->active != 1) {
                Auth::logout();
                return back()->with('error', 'Akun admin belum aktif/diverifikasi.');
            }
            
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors(['email' => 'Email atau password salah.'])->onlyInput('email');
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

        $verifyKey = Str::random(100);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
            'verify_key' => $verifyKey,
            'active' => 0,
        ]);

        $details = [
            'username' => $user->username,
            'role' => 'Admin',
            'website' => 'DP3A Tolikara',
            'datetime' => now()->format('Y-m-d H:i:s'),
            'url' => url('/admin/verify/' . $verifyKey)
        ];

        Mail::to($user->email)->send(new MailSend($details));

        return redirect()->route('admin.login')->with('success', 'Registrasi Admin berhasil! Cek email.');
    }

    public function verify($verifyKey)
    {
        $user = User::where('verify_key', $verifyKey)->where('role', 'admin')->first();
        if (!$user) {
            return redirect()->route('admin.login')->with('error', 'Link tidak valid.');
        }

        $user->update(['active' => 1, 'email_verified_at' => now(), 'verify_key' => null]);
        return redirect()->route('admin.login')->with('success', 'Email diverifikasi! Silakan login.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('branda');
    }
}