<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - DP3A Kabupaten Tolikara</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #0a2a44 0%, #1a4a7a 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        /* Overlay pattern untuk efek perlindungan */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" opacity="0.08"><path fill="white" d="M50 15 L65 30 L65 50 L50 65 L35 50 L35 30 Z M50 25 L60 35 L60 45 L50 55 L40 45 L40 35 Z" /></svg>');
            background-size: 80px 80px;
            background-repeat: repeat;
            pointer-events: none;
        }
        
        .login-card {
            background: rgba(255, 255, 255, 0.97);
            backdrop-filter: blur(10px);
            border: none;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .login-header {
            background: linear-gradient(135deg, #0a2a44 0%, #1a4a7a 100%);
            padding: 2rem;
            text-align: center;
            border-bottom: 3px solid #FF8F00;
            position: relative;
        }
        
        .login-header::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            right: 0;
            height: 10px;
            background: repeating-linear-gradient(45deg, #FF8F00, #FF8F00 10px, #FFB74D 10px, #FFB74D 20px);
        }
        
        .login-header i {
            font-size: 4rem;
            color: #FFB74D;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
            margin-bottom: 1rem;
        }
        
        .login-header h2 {
            color: white;
            font-weight: 700;
            margin-bottom: 0.5rem;
            font-size: 1.8rem;
        }
        
        .login-header p {
            color: rgba(255,255,255,0.9);
            margin-bottom: 0;
            font-size: 0.9rem;
        }
        
        .login-body {
            padding: 2.5rem;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-group label {
            color: #0a2a44;
            font-weight: 600;
            margin-bottom: 0.5rem;
            display: block;
            font-size: 0.95rem;
        }
        
        .input-group {
            position: relative;
        }
        
        .input-group-text {
            background: linear-gradient(135deg, #0a2a44, #1a4a7a);
            color: white;
            border: none;
            border-radius: 30px 0 0 30px;
            padding: 0.75rem 1.2rem;
        }
        
        .form-control {
            border: 2px solid #E8F0FE;
            border-left: none;
            border-radius: 0 30px 30px 0;
            padding: 0.75rem 1.2rem;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
        }
        
        .form-control:focus {
            border-color: #FF8F00;
            box-shadow: 0 0 0 0.25rem rgba(255, 143, 0, 0.25);
            outline: none;
        }
        
        .btn-login {
            background: linear-gradient(135deg, #0a2a44, #1a4a7a);
            color: white;
            border: none;
            border-radius: 30px;
            padding: 0.9rem;
            font-weight: 600;
            font-size: 1.1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            width: 100%;
            margin-top: 1rem;
            position: relative;
            overflow: hidden;
        }
        
        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s ease;
        }
        
        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(10, 42, 68, 0.4);
            background: linear-gradient(135deg, #FF8F00, #0a2a44);
        }
        
        .btn-login:hover::before {
            left: 100%;
        }
        
        .btn-login i {
            margin-right: 10px;
            color: #FFB74D;
        }
        
        .alert-danger {
            background: linear-gradient(135deg, #FFEBEE, #FFCDD2);
            border: none;
            border-left: 5px solid #B71C1C;
            border-radius: 10px;
            color: #B71C1C;
            padding: 1rem;
            margin-bottom: 1.5rem;
            font-weight: 500;
        }
        
        .alert-danger i {
            margin-right: 10px;
            color: #B71C1C;
        }
        
        .alert-success {
            background: linear-gradient(135deg, #E8F5E9, #C8E6C9);
            border: none;
            border-left: 5px solid #2E7D32;
            border-radius: 10px;
            color: #1B5E20;
            padding: 1rem;
            margin-bottom: 1.5rem;
            font-weight: 500;
        }
        
        .alert-success i {
            margin-right: 10px;
            color: #2E7D32;
        }
        
        .register-link {
            text-align: center;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 2px solid #E8F0FE;
        }
        
        .register-link p {
            color: #666;
            margin-bottom: 0;
        }
        
        .register-link a {
            color: #FF8F00;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .register-link a:hover {
            color: #0a2a44;
            text-decoration: underline;
        }
        
        /* Decorative elements - Ikon Perlindungan */
        .decoration-icon {
            position: absolute;
            font-size: 2.5rem;
            color: rgba(255, 255, 255, 0.15);
            z-index: 0;
        }
        
        .dec-1 {
            top: 10%;
            left: 5%;
            transform: rotate(-10deg);
        }
        
        .dec-2 {
            bottom: 10%;
            right: 5%;
            transform: rotate(10deg);
        }
        
        .dec-3 {
            top: 50%;
            left: 2%;
            transform: translateY(-50%);
            font-size: 3rem;
            opacity: 0.1;
        }
        
        .dec-4 {
            bottom: 15%;
            right: 3%;
            font-size: 3rem;
            opacity: 0.1;
        }
        
        /* Info card untuk layanan pengaduan */
        .info-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(5px);
            border-radius: 15px;
            padding: 1rem;
            margin-top: 2rem;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .info-card p {
            margin-bottom: 0;
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.85rem;
        }
        
        .info-card i {
            color: #FF8F00;
            margin-right: 5px;
        }
        
        .info-card a {
            color: #FFB74D;
            text-decoration: none;
        }
        
        .info-card a:hover {
            text-decoration: underline;
        }
        
        /* 🔥 DIUBAH: Menambahkan style untuk remember me checkbox */
        .remember-me {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 0.5rem;
        }
        
        .remember-me input {
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: #FF8F00;
        }
        
        .remember-me label {
            margin-bottom: 0;
            cursor: pointer;
            font-weight: normal;
            color: #555;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .login-body {
                padding: 1.5rem;
            }
            
            .login-header {
                padding: 1.5rem;
            }
            
            .login-header i {
                font-size: 3rem;
            }
            
            .login-header h2 {
                font-size: 1.3rem;
            }
            
            .decoration-icon {
                display: none;
            }
        }
    </style>
</head>
<body>
    <!-- Decorative elements - Ikon Perlindungan Perempuan dan Anak -->
    <div class="decoration-icon dec-1">
        <i class="bi bi-shield-heart"></i>
    </div>
    <div class="decoration-icon dec-2">
        <i class="bi bi-people"></i>
    </div>
    <div class="decoration-icon dec-3">
        <i class="bi bi-hand-index-thumb"></i>
    </div>
    <div class="decoration-icon dec-4">
        <i class="bi bi-heart-fill"></i>
    </div>
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="login-card" data-aos="fade-up" data-aos-duration="1000">
                    <!-- Header dengan tema DP3A -->
                    <div class="login-header">
                        <i class="bi bi-shield-heart-fill"></i>
                        <h2>DP3A Tolikara</h2>
                        <p>Dinas Pemberdayaan Perempuan dan Perlindungan Anak</p>
                        <p class="small mt-1">Kabupaten Tolikara - Papua Pegunungan</p>
                    </div>
                    
                    <!-- Body login -->
                    <div class="login-body">
                        @if(session('error'))
                        <div class="alert alert-danger" role="alert">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                            {{ session('error') }}
                        </div>
                        @endif
                        
                        @if(session('success'))
                        <div class="alert alert-success" role="alert">
                            <i class="bi bi-check-circle-fill"></i>
                            {{ session('success') }}
                        </div>
                        @endif
                        
                        <form action="{{ route('actionlogin') }}" method="POST">
                            @csrf
                            
                            <div class="form-group">
                                <label>
                                    <i class="bi bi-envelope-fill me-1" style="color: #FF8F00;"></i>
                                    Email
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-envelope"></i>
                                    </span>
                                    <input type="email" 
                                           name="email" 
                                           class="form-control" 
                                           placeholder="Masukkan email" 
                                           value="{{ old('email') }}"
                                           required>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label>
                                    <i class="bi bi-lock-fill me-1" style="color: #FF8F00;"></i>
                                    Password
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-lock"></i>
                                    </span>
                                    <input type="password" 
                                           name="password" 
                                           class="form-control" 
                                           placeholder="Masukkan password" 
                                           required>
                                </div>
                            </div>
                            
                            <!-- 🔥 DIUBAH: Menambahkan checkbox Remember Me (opsional) -->
                            <div class="remember-me">
                                <input type="checkbox" name="remember" id="remember">
                                <label for="remember">Ingat saya</label>
                            </div>
                            <!-- 🔥 END OF PERUBAHAN -->
                            
                            <button type="submit" class="btn-login">
                                <i class="bi bi-box-arrow-in-right"></i>
                                Masuk
                            </button>
                            
                            <div class="register-link">
                                <p>
                                    Belum punya akun? 
                                    <a href="{{ route('register') }}">
                                        Daftar sekarang <i class="bi bi-arrow-right"></i>
                                    </a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Info Layanan Pengaduan -->
                <div class="info-card" data-aos="fade-up" data-aos-delay="200">
                    <p>
                        <i class="bi bi-telephone-fill"></i> Butuh bantuan? 
                        <strong>Layanan Pengaduan 24 Jam</strong><br>
                        <i class="bi bi-whatsapp"></i> WhatsApp: 0812-XXXX-XXXX | 
                        <i class="bi bi-envelope-fill"></i> Email: dp3a@tolikarakab.go.id
                    </p>
                    <p class="small mt-1">
                        <i class="bi bi-shield-check"></i> Laporkan kasus kekerasan terhadap perempuan dan anak
                    </p>
                </div>
                
                <!-- Footer credit -->
                <p class="text-center text-white mt-4 opacity-75 small">
                    <i class="bi bi-c-circle"></i> {{ date('Y') }} DP3A Kabupaten Tolikara.<br>
                    Mewujudkan Kabupaten Tolikara yang ramah perempuan dan peduli anak
                </p>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>