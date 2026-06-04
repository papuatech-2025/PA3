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
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-image: linear-gradient(rgba(0, 0, 0, 0.55), rgba(0, 0, 0, 0.55)), 
                              url("{{ asset('assets/img/DPAD3.jpeg') }}");
            background-size: cover;
            background-position: center center;
            background-attachment: fixed;
            background-repeat: no-repeat;
            
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', system-ui, 'Roboto', sans-serif;
            padding: 1.5rem;
        }

        /* === LOGIN BOX GLASSMORPHISM === */
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
            transition: all 0.3s ease;
        }

        /* LOGO STYLING */
        .logo-wrapper {
            width: 90px;
            height: 90px;
            background: white;
            margin: 0 auto 1.5rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 12px;
            box-shadow: 0 0 20px rgba(233, 69, 96, 0.4);
            border: 3px solid #e94560; /* Merah aksen login */
            transition: all 0.4s ease;
        }

        .logo-wrapper:hover {
            transform: scale(1.08) rotate(3deg);
            box-shadow: 0 0 30px rgba(233, 69, 96, 0.6);
        }

        .logo-wrapper img {
            max-width: 100%;
            height: auto;
            object-fit: contain;
        }

        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-header h3 {
            font-weight: 700;
            font-size: 1.7rem;
            color: #ffffff;
            letter-spacing: 0.5px;
            text-shadow: 0 2px 5px rgba(0,0,0,0.3);
            margin-bottom: 5px;
        }

        .login-header p {
            color: rgba(255, 255, 255, 0.85);
            font-size: 0.85rem;
        }

        /* Form styling */
        .form-group { margin-bottom: 1.25rem; }
        .form-label {
            font-weight: 600;
            font-size: 0.85rem;
            color: #ffffff;
            margin-bottom: 0.4rem;
            display: block;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            font-size: 0.9rem;
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.9);
            color: #1a1a2e;
        }

        .form-control:focus {
            border-color: #e94560;
            box-shadow: 0 0 0 3px rgba(233, 69, 96, 0.3);
            outline: none;
        }

        .remember-lost {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 1.2rem 0 1.5rem;
            font-size: 0.85rem;
            color: white;
        }

        .checkbox-label {
            display: flex;
            align-items: center;
            gap: 0.45rem;
            cursor: pointer;
        }

        .lost-password {
            color: #ffb3c6;
            text-decoration: none;
            font-weight: 500;
        }

        .btn-login {
            width: 100%;
            background: linear-gradient(135deg, #1e2a3e, #2c3e50);
            border: none;
            padding: 0.8rem;
            font-weight: 700;
            color: white;
            border-radius: 12px;
            transition: 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #e94560, #c7364f);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(233, 69, 96, 0.4);
        }

        .go-to-link {
            text-align: center;
            margin-top: 2rem;
            padding-top: 1.2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.15);
        }

        .go-to-link a {
            text-decoration: none;
            font-weight: 600;
            font-size: 0.85rem;
            color: #ffffff;
            background: rgba(0,0,0,0.3);
            padding: 0.5rem 1.2rem;
            border-radius: 40px;
            transition: 0.3s;
        }

        .go-to-link a:hover {
            background: #e94560;
            color: white;
        }

        .register-subtle {
            text-align: center;
            margin-top: 1.2rem;
            font-size: 0.8rem;
            color: white;
        }

        .register-subtle a {
            color: #ffb3c6;
            text-decoration: none;
            font-weight: 600;
        }

        .alert-custom {
            border-radius: 12px;
            font-size: 0.8rem;
            padding: 0.7rem 1rem;
            margin-bottom: 1.5rem;
            background: rgba(248, 215, 218, 0.95);
            border-left: 4px solid #e94560;
            color: #842029;
        }
    </style>
</head>
<body>

    <div class="login-box" data-aos="zoom-in" data-aos-duration="600">
        <!-- Header with Logo -->
        <div class="login-header">
            <div class="logo-wrapper" data-aos="fade-down" data-aos-delay="300">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo DP3A Tolikara">
            </div>
            <h3>Login Admin</h3>
            <p>Panel Manajemen DP3A Kabupaten Tolikara</p>
        </div>

        @if(session('error'))
        <div class="alert-custom">
            <i class="bi bi-exclamation-triangle-fill"></i> {{ session('error') }}
        </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST">
            @csrf

            <div class="form-group">
                <label class="form-label">Username or Email</label>
                <input type="email" name="email" class="form-control" 
                       placeholder="admin@dp3a.com" 
                       value="{{ old('email') }}" required autofocus>
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" 
                       placeholder="Masukkan password" required>
            </div>

            <div class="remember-lost">
                <label class="checkbox-label">
                    <input type="checkbox" name="remember" style="accent-color:#e94560;">
                    <span>Remember Me</span>
                </label>
                <a href="#" class="lost-password">Lupa Password?</a>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ once: true });
    </script>
</body>
</html>