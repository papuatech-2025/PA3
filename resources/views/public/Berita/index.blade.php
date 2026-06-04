{{-- resources/views/public/berita/index.blade.php --}}
@extends('layouts.appi')

@section('title', 'Berita - DP3A Tolikara')
@section('meta_description', 'Berita terbaru dan informasi kegiatan Dinas Pemberdayaan Perempuan dan Perlindungan Anak Kabupaten Tolikara')
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/berita.css') }}">
@endpush

@section('content')

<section id="berita-dp3a-tolikara" class="section">
    <div class="container section-title" data-aos="fade-up">
        <h2>Berita & Informasi</h2>
        <p>Update terbaru kegiatan dan program Dinas P3A Kabupaten Tolikara</p>
    </div>

    <div class="container">
        <!-- Filter Section -->
        <div class="row mb-5" data-aos="fade-up">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <form method="GET" action="{{ route('public.berita.index') }}" class="row g-3">
                            <div class="col-md-8">
                                <label class="form-label fw-semibold">Cari Berita</label>
                                <input type="text" name="search" class="form-control" value="{{ request('search') }}" placeholder="Judul berita...">
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary w-100" style="background: #1a2744; border-color: #1a2744;">
                                    <i class="bi bi-search"></i> Cari
                                </button>
                            </div>
                            @if(request('search') || request('status'))
                            <div class="col-md-2 d-flex align-items-end">
                                <a href="{{ route('public.berita.index') }}" class="btn btn-secondary w-100">
                                    <i class="bi bi-x-circle"></i> Reset
                                </a>
                            </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daftar Berita (Grid 3 Kolom) - SEMUA BISA DIKLIK -->
        <div class="row gy-4 mb-5">
            @forelse($beritas as $berita)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 50 }}">
                <div class="card h-100 shadow-sm hover-effect border-0 clickable-card">
                    <!-- Link stretched yang mencakup seluruh card -->
                    <a href="{{ route('public.berita.show', $berita->id) }}" class="stretched-link"></a>
                    
                    <div class="position-relative overflow-hidden">
                        @if($berita->gambar)
                            <img src="{{ asset('storage/' . $berita->gambar) }}" 
                                 class="card-img-top" alt="{{ $berita->judul }}">
                        @else
                            <img src="{{ asset('assets/img/berita/default.jpg') }}" 
                                 class="card-img-top" alt="Default Image">
                        @endif
                        <div class="position-absolute top-0 end-0 m-2" style="z-index: 15;">
                            @if($berita->status == 'publish')
                                <span class="badge badge-publish">
                                    <i class="bi bi-check-circle-fill me-1"></i> Published
                                </span>
                            @else
                                <span class="badge badge-draft">
                                    <i class="bi bi-pencil me-1"></i> Draft
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title fw-bold">{{ $berita->judul }}</h5>
                        <p class="card-text text-muted small">{{ Str::limit(strip_tags($berita->isi), 100) }}</p>
                        
                        <div class="mb-3">
                            <span class="badge bg-light text-dark me-1">
                                <i class="bi bi-person"></i> {{ $berita->penulis }}
                            </span>
                            <span class="badge bg-light text-dark">
                                <i class="bi bi-eye"></i> {{ number_format($berita->dibaca) }} views
                            </span>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                <i class="bi bi-calendar3 me-1"></i>
                                {{ $berita->created_at->translatedFormat('d F Y') }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <i class="bi bi-inbox fs-1 text-muted d-block mb-3"></i>
                <h5 class="text-muted">Tidak ada berita yang ditemukan</h5>
                <p class="text-muted">Coba gunakan kata kunci pencarian yang berbeda</p>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="row">
            <div class="col-12">
                {{ $beritas->withQueryString()->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</section>

@endsection