@extends('layouts.appi')

@section('content')
<section class="py-5 bg-light min-vh-100">
    <div class="container">

        {{-- Breadcrumb --}}
        <nav aria-label="breadcrumb" class="mb-4" data-aos="fade-up">
            <ol class="breadcrumb small">
                <li class="breadcrumb-item">
                    <a href="/" class="text-decoration-none">
                        <i class="bi bi-house-door"></i> Beranda
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('public.layanan.index') }}" class="text-decoration-none">
                        Layanan
                    </a>
                </li>
                <li class="breadcrumb-item active text-dark fw-semibold">
                    {{ $layanan->nama_layanan }}
                </li>
            </ol>
        </nav>

        <div class="row justify-content-center">
            <div class="col-lg-10">

                <div class="card border-0 shadow-lg rounded-4 overflow-hidden" data-aos="fade-up">

                    {{-- Gambar --}}
                    @if($layanan->gambar)
                    <div class="position-relative">
                        <img src="{{ asset($layanan->gambar) }}"
                             class="w-100"
                             alt="{{ $layanan->nama_layanan }}"
                             style="height: 400px; object-fit: cover;">

                        <div class="position-absolute top-0 start-0 w-100 h-100"
                             style="background: rgba(0,0,0,0.35);">
                        </div>

                        {{-- Judul Overlay --}}
                        <div class="position-absolute bottom-0 start-0 p-4 text-white">
                            <div class="d-flex align-items-center">
                                @if($layanan->icon)
                                    <div class="bg-white text-primary rounded-circle d-flex align-items-center justify-content-center me-3"
                                         style="width:70px; height:70px;">
                                        <i class="{{ $layanan->icon }} fs-2"></i>
                                    </div>
                                @endif

                                <div>
                                    <h1 class="fw-bold mb-1">
                                        {{ $layanan->nama_layanan }}
                                    </h1>
                                    <p class="mb-0 text-light">
                                        Informasi layanan resmi Dinas Pemberdayaan Perempuan dan Perlindungan Anak
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    {{-- Isi --}}
                    <div class="card-body p-5">

                        {{-- Badge --}}
                        <div class="mb-4">
                            <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill">
                                <i class="bi bi-check-circle-fill"></i> Layanan Aktif
                            </span>
                        </div>

                        {{-- Deskripsi --}}
                        <div class="lh-lg text-secondary" style="text-align: justify; font-size: 16px;">
                            {!! nl2br(e($layanan->deskripsi)) !!}
                        </div>

                        {{-- Informasi tambahan --}}
                        <div class="row mt-5 g-4">

                            <div class="col-md-6">
                                <div class="p-4 border rounded-4 bg-light h-100">
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="bi bi-clock-history fs-3 text-primary me-3"></i>
                                        <h5 class="fw-bold mb-0">Jam Pelayanan</h5>
                                    </div>
                                    <p class="text-muted mb-0">
                                        Senin - Jumat <br>
                                        08.00 WIT - 15.00 WIT
                                    </p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="p-4 border rounded-4 bg-light h-100">
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="bi bi-telephone-fill fs-3 text-primary me-3"></i>
                                        <h5 class="fw-bold mb-0">Kontak Layanan</h5>
                                    </div>
                                    <p class="text-muted mb-0">
                                        Hubungi kantor DP3A Kabupaten Tolikara untuk informasi lebih lanjut.
                                    </p>
                                </div>
                            </div>

                        </div>

                        {{-- Tombol --}}
                        <div class="d-flex flex-wrap gap-3 mt-5">

                            <a href="{{ route('public.layanan.index') }}"
                               class="btn btn-outline-secondary px-4 py-2 rounded-pill">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>

                            <a href="{{ route('laporan.create') }}"
                               class="btn btn-primary px-4 py-2 rounded-pill shadow-sm">
                                <i class="bi bi-exclamation-circle"></i> Laporkan Kasus
                            </a>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection