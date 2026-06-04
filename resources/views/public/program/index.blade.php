@extends('layouts.appi')

@section('title', 'Program & Kegiatan - DP3A Tolikara')
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/program.css') }}">
@endpush

@section('content')

<div class="program-index-page">
    
    <!-- Hero Section -->
    <header class="hero-program">
        <div class="container" data-aos="fade-down">
            <h1>Program & Kegiatan</h1>
            <p>Inisiatif strategis kami dalam mewujudkan kesetaraan gender, pemberdayaan perempuan, dan perlindungan anak di Kabupaten Tolikara.</p>
        </div>
    </header>

    <!-- Search Section -->
    <div class="search-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="search-card">
                        <form method="GET" action="{{ route('program.index') }}" class="row g-3">
                            <div class="col-md-9">
                                <div class="position-relative">
                                    <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                                    <input type="text" name="search" class="form-control form-control-custom ps-5" value="{{ request('search') }}" placeholder="Cari berdasarkan nama program atau kata kunci...">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-search w-100 h-100">
                                    Temukan Program
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <section class="py-5 mt-4">
        <div class="container">
            
            <div class="row gy-5">
                @forelse($programs as $program)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 50 }}">
                    <div class="card-program shadow-sm" onclick="window.location='{{ route('program.show', $program->slug) }}'" style="cursor: pointer;">
                        
                        <div class="img-wrapper">
                            <span class="category-tag">{{ $program->kategori }}</span>
                            <img src="{{ $program->gambar ? asset('storage/'.$program->gambar) : asset('assets/img/program/default.jpg') }}" alt="{{ $program->nama_program }}">
                        </div>

                        <div class="card-body-content">
                            <h3 class="program-title">{{ $program->nama_program }}</h3>
                            <p class="program-excerpt">
                                {{ Str::limit(strip_tags($program->deskripsi), 120) }}
                            </p>
                            
                            <div class="meta-info">
                                <span>
                                    <i class="bi bi-geo-alt-fill"></i> {{ $program->lokasi ?: 'Tolikara' }}
                                </span>
                                <span>
                                    <i class="bi bi-calendar3"></i> 
                                    @if($program->tanggal_mulai)
                                        {{ \Carbon\Carbon::parse($program->tanggal_mulai)->translatedFormat('M Y') }}
                                    @else
                                        Terjadwal
                                    @endif
                                </span>
                            </div>
                        </div>

                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="empty-state">
                        <i class="bi bi-search-heart"></i>
                        <h4 class="fw-bold">Program Tidak Ditemukan</h4>
                        <p class="text-muted">Maaf, kami tidak menemukan program yang sesuai dengan kata kunci Anda.</p>
                        <a href="{{ route('program.index') }}" class="btn btn-outline-success rounded-pill px-4 mt-3">Tampilkan Semua Program</a>
                    </div>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="row mt-5">
                <div class="col-12 d-flex justify-content-center">
                    {{ $programs->withQueryString()->links('pagination::bootstrap-5') }}
                </div>
            </div>

        </div>
    </section>
</div>

@endsection