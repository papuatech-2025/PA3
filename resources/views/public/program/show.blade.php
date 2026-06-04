@extends('layouts.appi')

@section('title', $program->nama_program)
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/programshow.css') }}">
@endpush

@section('content')

<div class="program-detail-page">
    <div class="container">
        
        {{-- Breadcrumb --}}
        <div class="breadcrumb-wrapper">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('branda') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('program.index') }}">Daftar Program</a></li>
                    <li class="breadcrumb-item active text-truncate" style="max-width: 250px;">{{ $program->nama_program }}</li>
                </ol>
            </nav>
        </div>

        <div class="row">
            <div class="col-lg-8" data-aos="fade-up">
                
                {{-- Header Title --}}
                <div class="program-header">
                    <div class="program-meta-top">
                        <span class="badge-category">{{ $program->kategori }}</span>
                        @if($program->lokasi)
                        <div class="meta-item-top">
                            <i class="bi bi-geo-alt"></i> {{ $program->lokasi }}
                        </div>
                        @endif
                    </div>
                    <h1 class="program-title">{{ $program->nama_program }}</h1>
                </div>

                {{-- Image --}}
                @if($program->gambar)
                <div class="img-frame">
                    <img src="{{ asset('storage/' . $program->gambar) }}" alt="{{ $program->nama_program }}">
                </div>
                @endif

                {{-- Content Card --}}
                <div class="card-content">
                    <h2 class="content-label">Detail Pelaksanaan</h2>
                    <div class="description-text">
                        {!! nl2br(e($program->deskripsi)) !!}
                    </div>

                    {{-- Social Share --}}
                    <div class="share-wrapper border-top pt-4 mt-5">
                        <p class="small fw-bold text-muted text-uppercase mb-3">Bagikan Informasi ini</p>
                        <div class="d-flex gap-3">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="btn-share" title="Share ke Facebook">
                                <i class="bi bi-facebook fs-5"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}" target="_blank" class="btn-share" title="Share ke Twitter">
                                <i class="bi bi-twitter-x fs-5"></i>
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($program->nama_program . ' - ' . url()->current()) }}" target="_blank" class="btn-share" title="Share ke WhatsApp">
                                <i class="bi bi-whatsapp fs-5"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <a href="{{ route('program.index') }}" class="btn-back-custom mt-4">
                    <i class="bi bi-arrow-left-circle-fill fs-4"></i>
                    <span>Kembali ke Daftar Program</span>
                </a>
            </div>

            {{-- Sidebar Info --}}
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                <div class="sidebar-sticky">
                    <div class="info-card shadow-lg">
                        <h5 class="info-title">Informasi Program</h5>
                        
                        <div class="info-group">
                            <label>Status Pelaksanaan</label>
                            <div>
                                @if($program->status)
                                    <span class="status-pill status-active">Sedang Berjalan</span>
                                @else
                                    <span class="status-pill bg-light text-dark">Selesai</span>
                                @endif
                            </div>
                        </div>

                        <div class="info-group">
                            <label>Mulai Pelaksanaan</label>
                            <p>
                                <i class="bi bi-calendar-check me-2 text-warning"></i>
                                {{ \Carbon\Carbon::parse($program->tanggal_mulai)->translatedFormat('l, d F Y') }}
                            </p>
                        </div>

                        @if($program->tanggal_selesai)
                        <div class="info-group">
                            <label>Estimasi Selesai</label>
                            <p>
                                <i class="bi bi-calendar-event me-2 text-warning"></i>
                                {{ \Carbon\Carbon::parse($program->tanggal_selesai)->translatedFormat('l, d F Y') }}
                            </p>
                        </div>
                        @endif

                        <div class="info-group">
                            <label>Wilayah / Lokasi</label>
                            <p>
                                <i class="bi bi-pin-map-fill me-2 text-warning"></i>
                                {{ $program->lokasi ?: 'Wilayah Tolikara' }}
                            </p>
                        </div>

                        <div class="mt-4 pt-3 border-top border-secondary">
                            <p class="small opacity-75">
                                <i class="bi bi-info-circle me-1"></i>
                                Hubungi kantor DP3A Tolikara untuk informasi pendaftaran program.
                            </p>
                        </div>
                    </div>

                    {{-- Card Tambahan (Opsional: Hubungi Kami) --}}
                    <div class="card border-0 rounded-4 p-4 shadow-sm" style="background: var(--sage);">
                        <h6 class="fw-bold mb-2">Butuh Bantuan?</h6>
                        <p class="small text-muted mb-3">Tanyakan detail program ini kepada staf layanan kami.</p>
                        <a href="#" class="btn btn-sm btn-success w-100 rounded-pill py-2">
                            <i class="bi bi-whatsapp me-1"></i> WhatsApp Service
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection