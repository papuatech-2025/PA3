{{-- resources/views/public/about/index.blade.php --}}
@extends('layouts.public')

@section('title', 'Tentang Kami - DP3A Tolikara')
@section('meta_description', $about->deskripsi ?? 'Dinas Pemberdayaan Perempuan dan Perlindungan Anak Kabupaten Tolikara')
@section('meta_keywords', 'tentang, profil, visi, misi, DP3A, Tolikara')

@section('content')
<section class="hero-section" style="background: linear-gradient(135deg, #1a2e4a 0%, #0d1f35 100%); padding: 60px 0 40px;">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center text-white" data-aos="fade-up">
                <h1 class="display-4 fw-bold mb-3">Tentang Kami</h1>
                <p class="lead mb-0">Mengenal lebih dekat Dinas Pemberdayaan Perempuan dan Perlindungan Anak Kabupaten Tolikara</p>
                <nav aria-label="breadcrumb" class="mt-3">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white text-decoration-none">Home</a></li>
                        <li class="breadcrumb-item active text-white-50" aria-current="page">Tentang Kami</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

@if($about)
<section class="section py-5">
    <div class="container">
        <!-- Deskripsi -->
        <div class="row mb-5" data-aos="fade-up">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4 p-lg-5">
                        <h2 class="fw-bold mb-4">Sekilas Tentang DP3A Tolikara</h2>
                        <div class="about-content">
                            {!! nl2br(e($about->deskripsi)) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Visi & Misi -->
        <div class="row g-4 mb-5">
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4 p-lg-5 text-center">
                        <div class="mb-4">
                            <div class="rounded-circle bg-primary bg-opacity-10 d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                <i class="bi bi-eye display-4" style="color: #1a2e4a;"></i>
                            </div>
                        </div>
                        <h3 class="fw-bold mb-4">Visi</h3>
                        <div class="visi-content">
                            {!! nl2br(e($about->visi)) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4 p-lg-5">
                        <div class="text-center mb-4">
                            <div class="rounded-circle bg-accent bg-opacity-10 d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                <i class="bi bi-bullseye display-4" style="color: #F5A623;"></i>
                            </div>
                        </div>
                        <h3 class="fw-bold text-center mb-4">Misi</h3>
                        <div class="misi-content">
                            @if($misiList && count($misiList) > 0)
                                <ul class="list-unstyled">
                                    @foreach($misiList as $misi)
                                        @if(trim($misi))
                                        <li class="mb-3 d-flex align-items-start">
                                            <i class="bi bi-check-circle-fill text-accent me-3 mt-1"></i>
                                            <span>{{ trim($misi) }}</span>
                                        </li>
                                        @endif
                                    @endforeach
                                </ul>
                            @else
                                {!! nl2br(e($about->misi)) !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kontak & Alamat -->
        <div class="row" data-aos="fade-up">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4 p-lg-5">
                        <h3 class="fw-bold mb-4 text-center">Kontak Kami</h3>
                        <div class="row g-4">
                            <div class="col-md-4">
                                <div class="text-center">
                                    <div class="mb-3">
                                        <i class="bi bi-geo-alt display-4" style="color: #F5A623;"></i>
                                    </div>
                                    <h5 class="fw-bold mb-2">Alamat</h5>
                                    <p class="text-muted mb-0">{{ $about->alamat }}</p>
                                </div>
                            </div>
                            @if($about->telepon)
                            <div class="col-md-4">
                                <div class="text-center">
                                    <div class="mb-3">
                                        <i class="bi bi-telephone display-4" style="color: #F5A623;"></i>
                                    </div>
                                    <h5 class="fw-bold mb-2">Telepon</h5>
                                    <p class="text-muted mb-0">{{ $about->telepon }}</p>
                                </div>
                            </div>
                            @endif
                            @if($about->email)
                            <div class="col-md-4">
                                <div class="text-center">
                                    <div class="mb-3">
                                        <i class="bi bi-envelope display-4" style="color: #F5A623;"></i>
                                    </div>
                                    <h5 class="fw-bold mb-2">Email</h5>
                                    <p class="text-muted mb-0">
                                        <a href="mailto:{{ $about->email }}" class="text-decoration-none">{{ $about->email }}</a>
                                    </p>
                                </div>
                            </div>
                            @endif
                        </div>

                        <!-- Google Maps -->
                        @if($about->alamat)
                        <div class="mt-5">
                            <div class="ratio ratio-16x9">
                                <iframe 
                                    src="https://maps.google.com/maps?q={{ urlencode($about->alamat) }}&output=embed"
                                    style="border:0;" 
                                    allowfullscreen="" 
                                    loading="lazy">
                                </iframe>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@else
<section class="section py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center py-5">
                <i class="bi bi-info-circle display-1 text-muted mb-4 d-block"></i>
                <h3 class="text-muted">Informasi tentang kami belum tersedia</h3>
                <p class="text-muted">Mohon maaf, halaman tentang kami sedang dalam proses pembuatan.</p>
            </div>
        </div>
    </div>
</section>
@endif

@endsection