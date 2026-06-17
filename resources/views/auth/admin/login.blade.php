<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Admin - DP3A Kabupaten Tolikara</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            background-image: linear-gradient(rgba(0, 0, 0, 0.55), rgba(0, 0, 0, 0.55)), 
                              url("{{ asset('assets/img/DPAD3.jpeg') }}");
            background-size: cover;
            background-position: center center;
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', system-ui, sans-serif;
            padding: 1.5rem;
        }
        .login-box {
            max-width: 420px;
            width: 100%;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border-radius: 24px;
            padding: 2.5rem 2rem;
            box-shadow: 0 25px 45px rgba(0, 0, 0, 0.4);
            border: 1px solid rgba(255, 255, 255, 0.25);
        }
        .logo-wrapper {
            width: 90px; height: 90px;
            background: white; margin: 0 auto 1.5rem;
            border-radius: 50%; display: flex;
            align-items: center; justify-content: center;
            padding: 12px; border: 3px solid #e94560;
        }
        .logo-wrapper img { max-width: 100%; height: auto; }
        .login-header { text-align: center; margin-bottom: 2rem; color: white; }
        .form-group { margin-bottom: 1.25rem; }
        .form-label { font-weight: 600; font-size: 0.85rem; color: #ffffff; margin-bottom: 0.4rem; display: block; }
        .form-control {
            width: 100%; padding: 0.75rem 1rem;
            border-radius: 12px; background: rgba(255, 255, 255, 0.9);
        }
        /* Style untuk error */
        .form-control.is-invalid {
            border: 2px solid #ff4d4d !important;
            background: rgba(255, 230, 230, 0.95);
        }
        .error-text {
            color: #ffb3c6;
            font-size: 0.75rem;
            margin-top: 0.4rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 4px;
        }
        .btn-login {
            width: 100%; background: linear-gradient(135deg, #1e2a3e, #2c3e50);
            border: none; padding: 0.8rem; font-weight: 700; color: white;
            border-radius: 12px; transition: 0.3s; cursor: pointer;
        }
        .btn-login:hover { background: linear-gradient(135deg, #e94560, #c7364f); transform: translateY(-2px); }
        .remember-lost { display: flex; justify-content: space-between; align-items: center; margin: 1.2rem 0; font-size: 0.85rem; color: white; }
        .go-to-link { text-align: center; margin-top: 2rem; border-top: 1px solid rgba(255,255,255,0.15); padding-top: 1rem; }
        .go-to-link a { color: white; text-decoration: none; font-size: 0.85rem; background: rgba(0,0,0,0.3); padding: 0.5rem 1rem; border-radius: 20px; }
        .register-subtle { text-align: center; margin-top: 1rem; color: white; font-size: 0.8rem; }
        .register-subtle a { color: #ffb3c6; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>

    <div class="login-box" data-aos="zoom-in">
        <div class="login-header">
            <div class="logo-wrapper">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo">
            </div>
            <h3>Login Admin</h3>
            <p>Manajemen DP3A Kabupaten Tolikara</p>
        </div>

        <form action="{{ route('admin.login.submit') }}" method="POST">
            @csrf

            <!-- Field Email -->
            <div class="form-group">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" 
                       class="form-control @error('email') is-invalid @enderror" 
                       placeholder="admin@dp3a.com" 
                       value="{{ old('email') }}" required autofocus>
                @error('email')
                    <div class="error-text">
                        <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Field Password -->
            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password" 
                       class="form-control @error('password') is-invalid @enderror" 
                       placeholder="Masukkan password" required>
                @error('password')
                    <div class="error-text">
                        <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="remember-lost">
                <label style="cursor:pointer">
                    <input type="checkbox" name="remember" style="accent-color:#e94560;"> Remember Me
                </label>
                <a href="#" style="color:#ffb3c6; text-decoration:none">Lupa Password?</a>
            </div>

            <button type="submit" class="btn-login">
                <i class="bi bi-shield-lock-fill"></i> Masuk Sistem
            </button>

            <div class="go-to-link">
                <a href="{{ route('user.login') }}">
                    <i class="bi bi-person-circle"></i> Login sebagai User
                </a>
            </div>

            <div class="register-subtle">
                Belum punya akses admin? <a href="{{ route('admin.register') }}">Daftar di sini</a>
            </div>
        </form>
    </div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init();</script>
</body>
</html>