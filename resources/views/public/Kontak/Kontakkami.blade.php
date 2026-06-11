@extends('layouts.appi')

@section('content')

<!-- Hero Section -->
<section id="hero-contact" class="hero section dark-background py-5 contact-hero-bg">
    <div class="container text-center" data-aos="fade-up">
        <h1 class="display-4 fw-bold">Hubungi Kami</h1>
        <p class="lead">Kami siap melayani, mendengarkan, dan membantu Anda dalam perlindungan perempuan dan anak di Kabupaten Tolikara.</p>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="/" class="text-white">Beranda</a></li>
                <li class="breadcrumb-item active text-white-50" aria-current="page">Kontak</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Info Cards Section -->
<section id="contact-info" class="section py-5 bg-white">
    <div class="container">
        <div class="row gy-4">
            <!-- Alamat -->
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="card h-100 border-0 shadow-sm text-center p-4 card-hover-effect">
                    <div class="icon-box mx-auto mb-3 text-primary">
                        <i class="bi bi-geo-alt fs-2"></i>
                    </div>
                    <h5 class="fw-bold">Alamat Kantor</h5>
                    <p class="text-muted small">Kabor, Karubaga, Kabupaten Tolikara, Papua Pegunungan</p>
                </div>
            </div>

            <!-- Hotline -->
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="card h-100 border-0 shadow-sm text-center p-4 card-hover-effect border-bottom border-primary border-4">
                    <div class="icon-box mx-auto mb-3 text-primary">
                        <i class="bi bi-whatsapp fs-2"></i>
                    </div>
                    <h5 class="fw-bold">WhatsApp</h5>
                    <p class="text-muted small mb-0">+62 812-xxxx-xxxx</p>
                    <p class="text-muted small">Layanan Cepat & Tanggap</p>
                </div>
            </div>

            <!-- Email -->
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="card h-100 border-0 shadow-sm text-center p-4 card-hover-effect">
                    <div class="icon-box mx-auto mb-3 text-primary">
                        <i class="bi bi-envelope fs-2"></i>
                    </div>
                    <h5 class="fw-bold">Email Resmi</h5>
                    <p class="text-muted small">info@dp3a.tolikarakab.go.id<br>dp3atolikara@gmail.com</p>
                </div>
            </div>

            <!-- Jam Kerja -->
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="card h-100 border-0 shadow-sm text-center p-4 card-hover-effect">
                    <div class="icon-box mx-auto mb-3 text-primary">
                        <i class="bi bi-clock fs-2"></i>
                    </div>
                    <h5 class="fw-bold">Jam Kerja</h5>
                    <p class="text-muted small">Senin - Jumat<br>08.00 - 16.00 WIT</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Form & Map Section -->
<section id="contact-form-map" class="section py-5 bg-light">
    <div class="container">
        <div class="row g-5">
            <!-- Formulir -->
            <div class="col-lg-6" data-aos="fade-right">
                <div class="bg-white p-4 p-md-5 rounded shadow-sm border-top border-primary border-4">
                    <h3 class="fw-bold mb-4">Kirim Pesan</h3>
                    
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('public.kontak.send') }}" method="POST">
                        @csrf
                        <div class="row gy-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control bg-light" placeholder="Nama Anda" value="{{ old('name') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Alamat Email</label>
                                <input type="email" class="form-control bg-light" name="email" placeholder="Email Anda" value="{{ old('email') }}" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Subjek</label>
                                <input type="text" class="form-control bg-light" name="subject" placeholder="Perihal" value="{{ old('subject') }}" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Pesan</label>
                                <textarea class="form-control bg-light" name="message" rows="5" placeholder="Tuliskan pesan secara detail..." required>{{ old('message') }}</textarea>
                            </div>
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-primary btn-lg w-100 shadow-sm">Kirim Pesan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Google Maps -->
            <div class="col-lg-6" data-aos="fade-left">
                <div class="h-100 rounded shadow-sm overflow-hidden border" style="min-height: 400px;">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15933.24296996677!2d138.52000!3d-3.44000!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zM8KwMjYnMjQuMCJTIDEzOMKwMzEnMTIuMCJF!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" 
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- URGENT CTA SECTION - Warna Biru Senada Header/Footer -->
<section id="urgent-cta" class="section py-5 urgent-blue-section text-white">
    <div class="container text-center" data-aos="zoom-in">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="d-inline-block px-4 py-2 rounded-pill bg-white text-primary fw-bold mb-3 shadow-sm">
                    <span class="pulse-red-dot"></span> Layanan Darurat 24 Jam
                </div>
                <h2 class="fw-bold text-white mb-3">Darurat Kekerasan Terhadap Perempuan & Anak?</h2>
                <p class="lead mb-4 opacity-90">Segera hubungi tim penanganan cepat kami. Kami menjamin keamanan dan kerahasiaan identitas Anda.</p>
                
                <div class="d-flex flex-column flex-sm-row justify-content-center gap-3">
                    <a href="https://wa.me/628123456789" target="_blank" class="btn btn-light btn-lg px-5 rounded-pill fw-bold text-primary">
                        <i class="bi bi-whatsapp me-2"></i> WhatsApp Pengaduan
                    </a>
                    <a href="tel:129" class="btn btn-outline-light btn-lg px-5 rounded-pill fw-bold">
                        <i class="bi bi-telephone-fill me-2"></i> Call Center 129
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
    /* Hero Background dengan overlay biru tua agar matching */
    .contact-hero-bg {
        min-height: 40vh;
        display: flex;
        align-items: center;
        background-image:url("{{ asset('assets/img/DPAD3.jpeg') }}");
        background-position: center;
        background-size: cover;
    }

    .card-hover-effect {
        transition: all 0.3s ease;
    }

    .card-hover-effect:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 30px rgba(1, 41, 112, 0.1) !important;
    }

    /* WARNA SECTION DARURAT (Matching Blue Theme) */
    .urgent-blue-section {
        /* Menggunakan warna Biru Navy yang biasanya dipakai di Header/Footer */
        background-color: #012970; 
        background-image: radial-gradient(circle at 10% 20%, rgb(1, 31, 82) 0%, rgb(4, 37, 98) 90%);
        position: relative;
        overflow: hidden;
    }

    /* Dot Berkedip Kecil untuk aksen darurat */
    .pulse-red-dot {
        height: 10px;
        width: 10px;
        background-color: #ff4d4d;
        border-radius: 50%;
        display: inline-block;
        margin-right: 8px;
        animation: pulse-animation 1.5s infinite;
    }

    @keyframes pulse-animation {
        0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(255, 77, 77, 0.7); }
        70% { transform: scale(1); box-shadow: 0 0 0 10px rgba(255, 77, 77, 0); }
        100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(255, 77, 77, 0); }
    }

   

    .btn-primary:hover {
        background-color: #023da5;
        border-color: #023da5;
    }
</style>
@endpush