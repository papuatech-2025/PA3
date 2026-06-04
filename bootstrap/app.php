<?php
// bootstrap/app.php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        
        // Redirect guests (belum login) ke halaman login
        $middleware->redirectGuestsTo('/login');
        
        // Redirect users setelah login (default)
        // $middleware->redirectUsersTo('/'); // Hapus atau comment, karena kita handle di LoginController
        
        // ✅ REGISTRASI MIDDLEWARE ALIAS
        $middleware->alias([
            'role' => \App\Http\Middleware\CheckRole::class,
        ]);
        
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();