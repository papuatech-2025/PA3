@extends('layouts.appi')

@section('content')
<section id="layanan" class="py-5 bg-light">
    <div class="container">

        {{-- Header --}}
        <div class="text-center mb-5" data-aos="fade-up">

            <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill mb-3">
                <i class="bi bi-grid"></i> Layanan Resmi
            </span>

            <h2 class="display-5 fw-bold text-dark">
                Layanan Kami
            </h2>

            <p class="lead text-muted mx-auto" style="max-width: 700px;">
                Berbagai layanan resmi untuk mendukung pemberdayaan perempuan,
                perlindungan anak, edukasi masyarakat, dan pelayanan sosial
                di Kabupaten Tolikara.
            </p>

        </div>

        {{-- List Layanan --}}
        <div class="row g-4">

            @forelse($layanan as $item)

            <div class="col-md-6 col-lg-4"
                 data-aos="fade-up"
                 data-aos-delay="{{ $loop->iteration * 100 }}">

                {{-- Card --}}
                <div class="card layanan-card border-0 shadow-sm h-100 rounded-4 text-center p-4">

                    {{-- Icon Klik --}}
                    <a href="{{ route('public.layanan.show', $item->id_layanan) }}"
                       class="icon-link mx-auto mb-4 text-decoration-none">

                        <div class="icon-circle">

                            @if($item->icon)
                                <i class="{{ $item->icon }}"></i>
                            @else
                                <i class="bi bi-grid"></i>
                            @endif

                        </div>

                    </a>

                    {{-- Nama --}}
                    <h4 class="fw-bold mb-3">
                        {{ $item->nama_layanan }}
                    </h4>

                    {{-- Deskripsi --}}
                    <p class="text-muted mb-0" style="text-align: center;">
                        {{ Str::limit($item->deskripsi, 140) }}
                    </p>

                </div>

            </div>

            @empty

            <div class="col-12">

                <div class="text-center py-5">

                    <i class="bi bi-inbox display-1 text-muted"></i>

                    <h4 class="fw-bold mt-3">
                        Belum Ada Layanan
                    </h4>

                    <p class="text-muted">
                        Data layanan belum tersedia saat ini.
                    </p>

                </div>

            </div>

            @endforelse

        </div>
    </div>
</section>

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/layanan.css') }}">
@endpush
@endsection