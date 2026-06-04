<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // 1. Cek apakah sudah login
        if (!Auth::check()) {
            // Jika mencoba akses url admin, lempar ke login admin
            if ($request->is('admin') || $request->is('admin/*')) {
                return redirect()->route('admin.login');
            }
            // Jika akses url umum, lempar ke login user
            return redirect()->route('user.login');
        }

        $user = Auth::user();

        // 2. Cek apakah role user ada di dalam daftar role yang diizinkan (...$roles)
        if (!in_array($user->role, $roles)) {
            // Jika user biasa mencoba masuk ke area admin
            if ($user->role === 'user' && in_array('admin', $roles)) {
                return redirect()->route('branda')->with('error', 'Akses ditolak! Anda bukan Admin.');
            }
            
            // Jika admin mencoba masuk ke area khusus user
            if ($user->role === 'admin' && in_array('user', $roles)) {
                return redirect()->route('admin.dashboard');
            }

            abort(403, 'Akses Ditolak');
        }

        return $next($request);
    }
}