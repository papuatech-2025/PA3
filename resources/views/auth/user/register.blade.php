<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register User - DP3A Kabupaten Tolikara</title>
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
            background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), 
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
            position: relative;
        }

        /* DECORATION ICONS */
        .decoration-icon {
            position: absolute;
            font-size: 2.5rem;
            color: rgba(255, 255, 255, 0.05);
            z-index: 0;
        }
        .dec-1 { top: 10%; left: 5%; transform: rotate(-10deg); }
        .dec-2 { bottom: 10%; right: 5%; transform: rotate(10deg); }
        
        /* REGISTER CARD (Glassmorphism) */
        .register-card {
            max-width: 550px;
            width: 100%;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.4);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .register-header {
            background: rgba(0, 0, 0, 0.3);
            padding: 2.5rem 2rem 1.8rem;
            text-align: center;
            border-bottom: 3px solid #e94560; /* Warna Merah Login */
            position: relative;
        }

        /* LOGO WRAPPER */
        .logo-wrapper {
            width: 95px;
            height: 95px;
            background: white;
            margin: 0 auto 1.2rem;
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
            transform: scale(1.05);
            box-shadow: 0 0 30px rgba(233, 69, 96, 0.6);
        }

        .logo-wrapper img {
            max-width: 100%;
            height: auto;
        }
        
        .register-header h2 {
            color: white;
            font-weight: 700;
            margin-bottom: 0.3rem;
            font-size: 1.7rem;
            text-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }
        
        .register-header p {
            color: rgba(255,255,255,0.85);
            margin-bottom: 0;
            font-size: 0.85rem;
        }
        
        .register-body {
            padding: 2rem 2.5rem;
        }
        
        /* FORM CONTROLS */
        .form-group { margin-bottom: 1.2rem; }
        .form-group label {
            color: #ffffff;
            font-weight: 600;
            margin-bottom: 0.4rem;
            display: block;
            font-size: 0.85rem;
        }
        
        .input-group-text {
            background: rgba(0, 0, 0, 0.5);
            color: #ffb3c6; /* Pink lembut */
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-right: none;
            border-radius: 12px 0 0 12px;
        }
        
        .form-control {
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 0 12px 12px 0;
            padding: 0.7rem 1rem;
            background: rgba(255, 255, 255, 0.9);
            color: #1a1a2e;
            font-size: 0.9rem;
        }
        
        .form-control:focus {
            border-color: #e94560;
            box-shadow: 0 0 0 3px rgba(233, 69, 96, 0.3);
            background: white;
            outline: none;
        }
        
        /* BUTTON (Sama dengan Login) */
        .btn-register {
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
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: 1rem;
        }
        
        .btn-register:hover {
            background: linear-gradient(135deg, #e94560, #c7364f);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(233, 69, 96, 0.4);
        }
        
        .login-link {
            text-align: center;
            margin-top: 1.5rem;
            color: white;
            font-size: 0.85rem;
        }
        
        .login-link a {
            color: #ffb3c6;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover { text-decoration: underline; }

        /* INFO & FOOTER */
        .info-card {
            background: rgba(0, 0, 0, 0.3);
            border-radius: 15px;
            padding: 0.8rem;
            margin-top: 1.5rem;
            color: rgba(255,255,255,0.8);
            text-align: center;
            font-size: 0.75rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .go-to-admin {
            text-align: center;
            margin-top: 1rem;
        }
        .go-to-admin a {
            color: rgba(255,255,255,0.6);
            text-decoration: none;
            font-size: 0.75rem;
            background: rgba(0,0,0,0.2);
            padding: 0.4rem 1rem;
            border-radius: 20px;
            transition: 0.3s;
        }
        .go-to-admin a:hover { color: #e94560; background: rgba(0,0,0,0.4); }

        /* ALERT CUSTOM */
        .alert-custom {
            background: rgba(248, 215, 218, 0.95);
            border-left: 4px solid #e94560;
            border-radius: 10px;
            padding: 0.7rem;
            margin-bottom: 1rem;
            font-size: 0.8rem;
            color: #842029;
        }
    </style>
</head>
<body>
    <div class="decoration-icon dec-1"><i class="bi bi-shield-heart"></i></div>
    <div class="decoration-icon dec-2"><i class="bi bi-people"></i></div>
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="register-card" data-aos="zoom-in" data-aos-duration="600">
                    <div class="register-header">
                        <div class="logo-wrapper" data-aos="fade-down" data-aos-delay="200">
                            <img src="{{ asset('assets/img/logo.png') }}" alt="Logo DP3A">
                        </div>
                        <h2>Daftar Akun</h2>
                        <p>Sistem Informasi DP3A Kabupaten Tolikara</p>
                    </div>
                    
                    <div class="register-body">
                        @if($errors->any())
                        <div class="alert-custom">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                            </ul>
                        </div>
                        @endif
                        
                        <form action="{{ route('user.register.submit') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Alamat Email</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                    <input type="email" name="email" class="form-control" placeholder="user@example.com" value="{{ old('email') }}" required>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label>Username</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                                    <input type="text" name="username" class="form-control" placeholder="Username" value="{{ old('username') }}" required>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label>Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                    <input type="password" name="password" class="form-control" placeholder="Minimal 6 karakter" required>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label>Konfirmasi Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-shield-lock"></i></span>
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password" required>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn-register">
                                <i class="bi bi-person-plus-fill"></i> Daftar Sekarang
                            </button>
                            
                            <div class="login-link">
                                Sudah punya akun? <a href="{{ route('user.login') }}">Login di sini</a>
                            </div>
                        </form>
                    </div>
                </div>
                
                <div class="info-card">
                    <i class="bi bi-info-circle me-1" style="color:#ffb3c6"></i> 
                    Data Anda akan digunakan untuk keperluan layanan perlindungan masyarakat.
                </div>

                <div class="go-to-admin">
                    <a href="{{ route('admin.login') }}"><i class="bi bi-shield-lock-fill me-1"></i> Login Panel Admin</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ once: true });
    </script>
</body>
</html>