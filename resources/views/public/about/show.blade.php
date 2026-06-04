{{-- resources/views/public/about/show.blade.php --}}
@extends('layouts.public')

@section('title', 'Detail Profil - DP3A Tolikara')
@section('meta_description', 'Detail informasi profil Dinas Pemberdayaan Perempuan dan Perlindungan Anak Kabupaten Tolikara')

@section('content')
<section class="hero-section" style="background: linear-gradient(135deg, #1a2e4a 0%, #0d1f35 100%); padding: 60px 0 40px;">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center text-white" data-aos="fade-up">
                <h1 class="display-4 fw-bold mb-3">Detail Profil</h1>
                <p class="lead mb-0">Informasi lengkap tentang DP3A Kabupaten Tolikara</p>
                <nav aria-label="breadcrumb" class="mt-3">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white text-decoration-none">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('public.about.index') }}" class="text-white text-decoration-none">Tentang Kami</a></li>
                        <li class="breadcrumb-item active text-white-50" aria-current="page">Detail</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<section class="section py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card border-0 shadow-sm" data-aos="fade-up">
                    <div class="card-body p-4 p-lg-5">
                        <h2 class="fw-bold mb-4">{{ $about->deskripsi ? 'Profil DP3A Tolikara' : 'Informasi' }}</h2>
                        
                        @if($about->deskripsi)
                        <div class="mb-5">
                            <h4 class="fw-semibold mb-3">Deskripsi</h4>
                            <div class="about-content">
                                {!! nl2br(e($about->deskripsi)) !!}
                            </div>
                        </div>
                        @endif
                        
                        @if($about->visi)
                        <div class="mb-5">
                            <h4 class="fw-semibold mb-3">Visi</h4>
                            <div class="visi-content p-4 bg-light rounded">
                                {!! nl2br(e($about->visi)) !!}
                            </div>
                        </div>
                        @endif
                        
                        @if($about->misi)
                        <div class="mb-5">
                            <h4 class="fw-semibold mb-3">Misi</h4>
                            <div class="misi-content p-4 bg-light rounded">
                                {!! nl2br(e($about->misi)) !!}
                            </div>
                        </div>
                        @endif
                        
                        <div class="mt-4">
                            <a href="{{ route('public.about.index') }}" class="btn btn-primary rounded-pill px-4">
                                <i class="bi bi-arrow-left me-2"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.about-content {
    font-size: 1.05rem;
    line-height: 1.8;
}
.visi-content, .misi-content {
    font-size: 1rem;
    line-height: 1.7;
}
</style>
@endsection