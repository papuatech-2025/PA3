<?php
// app/Http/Middleware/CheckRole.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();
        
        // Jika role user tidak ada di daftar role yang diizinkan
        if (!in_array($user->role, $roles)) {
            abort(403, 'Unauthorized - Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}