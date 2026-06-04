protected $routeMiddleware = [
    'auth' => \App\Http\Middleware\Authenticate::class,
    'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,

    // TAMBAHKAN INI 🔥
    'role' => \App\Http\Middleware\RoleMiddleware::class,
];