{{-- resources/views/public/pengumuman.blade.php --}}
@extends('layouts.appi')

@section('title', 'Pengumuman Resmi')

@section('content')

<div class="container py-5">

    {{-- Header --}}
    <div class="text-center mb-5">
        <div class="mb-3">
            <i class="bi bi-megaphone-fill text-primary" style="font-size: 60px;"></i>
        </div>

        <h1 class="fw-bold mb-2">
            Pengumuman Resmi
        </h1>

        <p class="text-muted fs-5">
            Informasi terbaru dari Dinas Pemberdayaan Perempuan dan Perlindungan Anak
        </p>
    </div>

    {{-- List Pengumuman --}}
    <div class="row justify-content-center">

        @forelse($pengumuman as $item)

        <div class="col-lg-10 mb-4">

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

                {{-- Header Card --}}
                <div class="card-header bg-primary text-white border-0 py-3 px-4">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">

                        <h4 class="mb-2 mb-md-0 fw-bold">
                            <i class="bi bi-bell-fill me-2"></i>
                            {{ $item->judul }}
                        </h4>

                        <span class="badge bg-light text-dark px-3 py-2 rounded-pill">
                            <i class="bi bi-calendar-event"></i>
                            {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y | H:i') }}
                        </span>

                    </div>
                </div>

                {{-- Body --}}
                <div class="card-body p-4">

                    <div class="card-text text-secondary"
                         style="text-align: justify; line-height: 1.9; font-size: 16px;">

                        {!! nl2br(e($item->isi)) !!}

                    </div>

                </div>

                {{-- Footer --}}
                <div class="card-footer bg-light border-0 px-4 py-3">

                    <div class="d-flex justify-content-between align-items-center flex-wrap">

                        <div class="text-muted small">
                            <i class="bi bi-person-circle me-1"></i>
                            Dipublikasikan oleh Admin
                        </div>

                        <div class="text-muted small">
                            <i class="bi bi-clock-history me-1"></i>
                            Update terbaru
                        </div>

                    </div>

                </div>

            </div>

        </div>

        @empty

        {{-- Empty State --}}
        <div class="col-lg-8">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body text-center py-5">

                    <i class="bi bi-inbox text-muted"
                       style="font-size: 80px;"></i>

                    <h4 class="mt-4 text-muted fw-bold">
                        Belum Ada Pengumuman
                    </h4>

                    <p class="text-muted mb-0">
                        Pengumuman terbaru akan ditampilkan di halaman ini.
                    </p>

                </div>

            </div>

        </div>

        @endforelse

    </div>

    {{-- Pagination --}}
    @if($pengumuman->hasPages())
    <div class="d-flex justify-content-center mt-5">
        {{ $pengumuman->links() }}
    </div>
    @endif

</div>

@endsection