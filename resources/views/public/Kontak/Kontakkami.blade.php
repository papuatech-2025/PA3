@extends('layouts.appi')

@section('content')

<!-- Hero Section Khusus Kontak -->
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

<section id="contact-info" class="section py-5">
    <div class="container">
        <div class="row gy-4">
            
            <!-- Info Alamat -->
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="card h-100 border-0 shadow-sm text-center p-4">
                    <div class="icon-circle mx-auto mb-3 bg-primary text-white">
                        <i class="bi bi-geo-alt fs-3"></i>
                    </div>
                    <h5 class="fw-bold">Alamat Kantor</h5>
                    <p class="text-muted small">Kabor, Karubaga, Kabupaten Tolikara, Papua Pegunungan</p>
                </div>
            </div>

            <!-- Info Telepon / Hotline -->
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="card h-100 border-0 shadow-sm text-center p-4 border-bottom border-primary border-4">
                    <div class="icon-circle mx-auto mb-3 bg-success text-white">
                        <i class="bi bi-whatsapp fs-3"></i>
                    </div>
                    <h5 class="fw-bold">Hotline Pengaduan</h5>
                    <p class="text-muted small mb-0">+62 812-xxxx-xxxx</p>
                    <p class="text-muted small">Tersedia 24 Jam untuk Darurat</p>
                </div>
            </div>

            <!-- Info Email -->
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="card h-100 border-0 shadow-sm text-center p-4">
                    <div class="icon-circle mx-auto mb-3 bg-danger text-white">
                        <i class="bi bi-envelope fs-3"></i>
                    </div>
                    <h5 class="fw-bold">Email Resmi</h5>
                    <p class="text-muted small">info@dp3a.tolikarakab.go.id<br>dp3atolikara@gmail.com</p>
                </div>
            </div>

            <!-- Jam Operasional -->
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="card h-100 border-0 shadow-sm text-center p-4">
                    <div class="icon-circle mx-auto mb-3 bg-warning text-dark">
                        <i class="bi bi-clock fs-3"></i>
                    </div>
                    <h5 class="fw-bold">Jam Kerja</h5>
                    <p class="text-muted small">Senin - Jumat<br>08.00 - 16.00 WIT</p>
                </div>
            </div>

        </div>
    </div>
</section>

<section id="contact-form-map" class="section py-5 light-background">
    <div class="container">
        <div class="row g-5">
            
            <!-- Formulir Kontak -->
            <div class="col-lg-6" data-aos="fade-right">
                <div class="bg-white p-4 p-md-5 rounded shadow-sm">
                    <h3 class="fw-bold mb-4">Kirim Pesan</h3>
                    
                    {{-- Alert Pesan Sukses --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- Alert Error Validasi --}}
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <p class="text-muted mb-4">Punya pertanyaan atau ingin menyampaikan aspirasi? Silakan isi formulir di bawah ini.</p>
                    
                    <form action="{{ route('public.kontak.send') }}" method="POST" class="php-email-form">
                        @csrf
                        <div class="row gy-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Nama Anda" value="{{ old('name') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Alamat Email</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Email Anda" value="{{ old('email') }}" required>
                            </div>
                            <div class="col-12">
                                <label for="subject" class="form-label">Subjek / Perihal</label>
                                <input type="text" class="form-control" name="subject" id="subject" placeholder="Contoh: Konsultasi Layanan" value="{{ old('subject') }}" required>
                            </div>
                            <div class="col-12">
                                <label for="message" class="form-label">Pesan Anda</label>
                                <textarea class="form-control" name="message" rows="5" placeholder="Tuliskan pesan secara detail..." required>{{ old('message') }}</textarea>
                            </div>
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-primary btn-lg w-100">Kirim Pesan Sekarang</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Google Maps Embed -->
            <div class="col-lg-6" data-aos="fade-left">
                <div class="h-100 rounded shadow-sm overflow-hidden" style="min-height: 400px;">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15933.24296996677!2d138.52000!3d-3.44000!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zM8KwMjYnMjQuMCJTIDEzOMKwMzEnMTIuMCJF!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" 
                        width="100%" 
                        height="100%" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Call to Action Section -->
<section id="urgent-cta" class="section py-5 bg-danger text-white">
    <div class="container text-center" data-aos="zoom-in">
        <h2 class="fw-bold text-white">Darurat Kekerasan?</h2>
        <p class="lead mb-4">Segera hubungi tim penanganan cepat kami. Kerahasiaan identitas pelapor terjamin sepenuhnya.</p>
        <a href="https://wa.me/628123456789" target="_blank" class="btn btn-light btn-lg px-5 rounded-pill">
            <i class="bi bi-telephone-fill me-2"></i> Hubungi Tim Reaksi Cepat (SAPA 129)
        </a>
    </div>
</section>

@endsection

@push('styles')
<style>
    /* Perbaikan Error CSS Inline Background */
    .contact-hero-bg {
        min-height: 40vh;
        display: flex;
        align-items: center;
        background-image: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url("{{ asset('assets/img/DPAD3.jpeg') }}");
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
    }

    .icon-circle {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition: transform 0.3s ease;
    }

    .card:hover .icon-circle {
        transform: scale(1.1);
    }

    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.1);
    }

    .php-email-form label {
        font-weight: 600;
        color: #444;
    }

    /* Memastikan Maps responsif */
    iframe {
        min-height: 400px;
        width: 100%;
    }
</style>
@endpush