<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Admin - DP3A Kabupaten Tolikara</title>
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

        /* === LOGO STYLING === */
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
            border: 3px solid #e94560;
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

        .register-box {
            max-width: 520px;
            width: 100%;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-radius: 20px;
            padding: 2rem 2rem 2rem 2rem;
            box-shadow: 0 25px 45px rgba(0, 0, 0, 0.3);
            transition: all 0.2s ease;
            border: 1px solid rgba(255, 255, 255, 0.25);
        }

        .register-header {
            text-align: center;
            margin-bottom: 1.8rem;
        }

        .register-header h3 {
            font-weight: 700;
            font-size: 1.7rem;
            color: #ffffff;
            letter-spacing: -0.3px;
            text-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        .register-header p {
            color: rgba(255, 255, 255, 0.85);
            font-size: 0.85rem;
            margin-top: 6px;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-label {
            font-weight: 600;
            font-size: 0.85rem;
            color: #ffffff;
            margin-bottom: 0.4rem;
            display: block;
            text-shadow: 0 1px 2px rgba(0,0,0,0.1);
        }

        .form-control {
            width: 100%;
            padding: 0.7rem 0.9rem;
            font-size: 0.9rem;
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 12px;
            transition: 0.2s;
            background: rgba(255, 255, 255, 0.9);
            color: #1a1a2e;
        }

        .form-control:focus {
            border-color: #e94560;
            outline: none;
            box-shadow: 0 0 0 3px rgba(233, 69, 96, 0.3);
            background: rgba(255, 255, 255, 1);
        }

        .btn-register {
            width: 100%;
            background: linear-gradient(135deg, #1e2a3e, #2c3e50);
            border: none;
            padding: 0.75rem;
            font-weight: 700;
            font-size: 0.95rem;
            color: white;
            border-radius: 12px;
            transition: 0.25s;
            letter-spacing: 0.3px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 0.5rem;
        }

        .btn-register:hover {
            background: linear-gradient(135deg, #e94560, #c7364f);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
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

        .alert-custom i {
            margin-right: 8px;
        }

        .alert-success-custom {
            background: rgba(209, 231, 221, 0.95);
            border-left: 4px solid #198754;
            color: #0a3622;
        }

        .password-strength {
            margin-top: 0.5rem;
        }
        .strength-meter {
            height: 4px;
            border-radius: 4px;
            background: rgba(255, 255, 255, 0.4);
            margin-top: 5px;
            overflow: hidden;
        }
        .strength-meter-fill {
            height: 100%;
            width: 0%;
            transition: width 0.3s ease;
        }
        .strength-weak .strength-meter-fill { background: #dc3545; width: 33%; }
        .strength-medium .strength-meter-fill { background: #e94560; width: 66%; }
        .strength-strong .strength-meter-fill { background: #198754; width: 100%; }
        .strength-text {
            font-size: 0.7rem;
            margin-top: 4px;
            display: flex;
            align-items: center;
            gap: 5px;
            color: rgba(255, 255, 255, 0.85);
        }

        .secret-info {
            background: rgba(255, 255, 255, 0.2);
            padding: 0.5rem 0.7rem;
            border-radius: 10px;
            margin-top: 0.5rem;
            font-size: 0.75rem;
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: rgba(255, 255, 255, 0.95);
        }
        .secret-info strong {
            color: #ffb3c6;
        }

        .login-link {
            text-align: center;
            margin-top: 1.8rem;
            padding-top: 1rem;
            border-top: 1px solid rgba(255, 255, 255, 0.25);
        }

        .login-link p {
            margin-bottom: 0.5rem;
            color: rgba(255, 255, 255, 0.85);
            font-size: 0.85rem;
        }

        .login-link a {
            color: #ffb3c6;
            font-weight: 600;
            text-decoration: none;
        }

        .login-link a:hover {
            color: #ffffff;
            text-decoration: underline;
        }

        .go-to-link {
            text-align: center;
            margin-top: 0.8rem;
        }

        .go-to-link a {
            text-decoration: none;
            font-weight: 600;
            font-size: 0.8rem;
            color: #ffffff;
            transition: 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(0, 0, 0, 0.3);
            padding: 0.3rem 1rem;
            border-radius: 40px;
        }

        .go-to-link a:hover {
            color: #e94560;
            background: rgba(255, 255, 255, 0.2);
        }

        @media (max-width: 480px) {
            .register-box {
                padding: 1.5rem;
            }
            .register-header h3 {
                font-size: 1.4rem;
            }
        }
    </style>
</head>
<body>

    <div class="register-box" data-aos="fade-up" data-aos-duration="500">
        <!-- Header with Logo -->
        <div class="register-header">
            <div class="logo-wrapper" data-aos="fade-down" data-aos-delay="300">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo DP3A Tolikara">
            </div>
            <h3>Daftar Admin</h3>
            <p>DP3A Kabupaten Tolikara · Akses Administrator</p>
        </div>

        <!-- Session Alerts -->
        @if(session('error'))
        <div class="alert-custom">
            <i class="bi bi-exclamation-triangle-fill"></i> {{ session('error') }}
        </div>
        @endif

        @if(session('success'))
        <div class="alert-custom alert-success-custom">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
        </div>
        @endif

        @if($errors->any())
        <div class="alert-custom">
            <i class="bi bi-exclamation-triangle-fill"></i>
            @foreach($errors->all() as $error) {{ $error }}<br> @endforeach
        </div>
        @endif

        <form action="{{ route('admin.register.submit') }}" method="POST">
            @csrf

            <!-- Email Admin -->
            <div class="form-group">
                <label class="form-label">Email Admin</label>
                <input type="email" name="email" class="form-control" 
                       placeholder="admin@dp3a.com" value="{{ old('email') }}" required>
            </div>

            <!-- Username -->
            <div class="form-group">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" 
                       placeholder="Masukkan username" value="{{ old('username') }}" required>
            </div>

            <!-- Password + strength meter -->
            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" 
                       placeholder="Minimal 6 karakter" required>
                <div class="password-strength" id="passwordStrength">
                    <div class="strength-meter">
                        <div class="strength-meter-fill"></div>
                    </div>
                    <div class="strength-text">
                        <i class="bi bi-info-circle"></i> 
                        <span id="strengthMessage">Gunakan minimal 6 karakter</span>
                    </div>
                </div>
            </div>

            <!-- Konfirmasi Password -->
            <div class="form-group">
                <label class="form-label">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control" 
                       placeholder="Ulangi password" required>
            </div>

            <!-- Kode Rahasia Admin -->
            <div class="form-group">
                <label class="form-label">Kode Rahasia Admin</label>
                <input type="password" name="secret_code" class="form-control" 
                       placeholder="Masukkan kode rahasia" required>
                <div class="secret-info">
                    <i class="bi bi-key-fill me-1" style="color:#ffb3c6;"></i> 
                    Kode rahasia: <strong>ADMIN123</strong>
                </div>
            </div>

            <button type="submit" class="btn-register">
                <i class="bi bi-person-plus"></i> Daftar sebagai Admin
            </button>

            <div class="login-link">
                <p>Sudah punya akun admin? 
                    <a href="{{ route('admin.login') }}">Login disini <i class="bi bi-arrow-right"></i></a>
                </p>
                <div class="go-to-link">
                    <a href="{{ route('user.login') }}">
                        <i class="bi bi-arrow-right-circle"></i> Go to Born To Be Wild
                    </a>
                </div>
                <p class="mt-2 small">
                    <a href="{{ route('user.register') }}" style="font-weight:500; opacity:0.85;">
                        <i class="bi bi-arrow-left"></i> Daftar sebagai User Biasa
                    </a>
                </p>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 800, once: true });

        const passwordInput = document.getElementById('password');
        const strengthDiv = document.getElementById('passwordStrength');
        const strengthMsgSpan = document.getElementById('strengthMessage');

        if (passwordInput) {
            passwordInput.addEventListener('input', function(e) {
                const password = e.target.value;
                strengthDiv.classList.remove('strength-weak', 'strength-medium', 'strength-strong');
                
                if (password.length === 0) {
                    strengthMsgSpan.innerText = 'Gunakan minimal 6 karakter';
                } else if (password.length < 6) {
                    strengthDiv.classList.add('strength-weak');
                    strengthMsgSpan.innerText = '🔒 Lemah';
                } else if (password.length < 10) {
                    strengthDiv.classList.add('strength-medium');
                    strengthMsgSpan.innerText = '⚡ Sedang';
                } else {
                    strengthDiv.classList.add('strength-strong');
                    strengthMsgSpan.innerText = '✅ Kuat';
                }
            });
        }
    </script>
</body>
</html>