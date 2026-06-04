{{-- resources/views/public/struktur/index.blade.php --}}
@extends('layouts.appi')

@section('title', 'Struktur Organisasi - DP3A Tolikara')
@section('meta_description', 'Struktur organisasi Dinas Pemberdayaan Perempuan dan Perlindungan Anak Kabupaten Tolikara')

{{-- CSS --}}
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/struktur.css') }}">
@endpush

@section('content')

<div class="public-struktur">

    {{-- HERO --}}
    <div class="hero-struktur">
        <div class="breadcrumb-custom">
            <a href="{{ url('/') }}">Beranda</a>
            <span>/</span>
            <span>Struktur Organisasi</span>
        </div>

        <h1>Struktur Organisasi</h1>

        <p class="text-white opacity-75">
            Mengenal lebih dekat tim di balik DP3A Kabupaten Tolikara
        </p>
    </div>

    <div class="struktur-container">

        {{-- PIMPINAN --}}
        @if($pimpinan)

        <div class="section-header">
            <span class="badge">Top Management</span>
            <h2>Kepala Dinas</h2>
            <div class="line"></div>
        </div>

        <div class="grid-pimpinan">
            <div style="max-width: 400px; width:100%;">

                <div class="card-struktur">

                    <div class="avatar-container">

                        @if($pimpinan->foto)

                            <img src="{{ asset('storage/' . $pimpinan->foto) }}"
                                 class="img-pimpinan"
                                 alt="{{ $pimpinan->nama }}">

                        @else

                            <div class="avatar-placeholder img-pimpinan d-flex align-items-center justify-content-center">
                                <i class="fas fa-user fa-4x text-muted"></i>
                            </div>

                        @endif

                    </div>

                    <h3 class="name-text" style="font-size:1.5rem;">
                        {{ $pimpinan->nama }}
                    </h3>

                    <p class="jabatan-text">
                        {{ $pimpinan->jabatan }}
                    </p>

                    <span class="badge-aktif">
                        <i class="fas fa-check-circle me-1"></i>
                        Pejabat Aktif
                    </span>

                </div>

            </div>
        </div>

        <div class="hierarki-connector"></div>

        @endif


        {{-- SEKRETARIAT --}}
        @if($wakil || $sekretaris || $bendahara)

        <div class="section-header">
            <span class="badge">Administration</span>
            <h2>Sekretariat & Manajemen</h2>
            <div class="line"></div>
        </div>

        <div class="grid-sekretariat">

            @foreach([$wakil, $sekretaris, $bendahara] as $pejabat)

                @if($pejabat)

                <div class="card-struktur">

                    <div class="avatar-container">

                        @if($pejabat->foto)

                            <img src="{{ asset('storage/' . $pejabat->foto) }}"
                                 class="img-sekretariat"
                                 alt="{{ $pejabat->nama }}">

                        @else

                            <div class="avatar-placeholder img-sekretariat d-flex align-items-center justify-content-center">
                                <i class="fas fa-user fa-3x text-muted"></i>
                            </div>

                        @endif

                    </div>

                    <h4 class="name-text" style="font-size:1.2rem;">
                        {{ $pejabat->nama }}
                    </h4>

                    <p class="jabatan-text">
                        {{ $pejabat->jabatan }}
                    </p>

                </div>

                @endif

            @endforeach

        </div>

        <div class="hierarki-connector"></div>

        @endif


        {{-- STAF --}}
        @if($anggota && $anggota->count() > 0)

        <div class="section-header">
            <span class="badge">Professional Staff</span>
            <h2>Tenaga Ahli & Staf</h2>
            <div class="line"></div>
        </div>

        <div class="grid-staf">

            @foreach($anggota as $item)

            <div class="card-struktur" style="padding:1.5rem;">

                <div class="avatar-container">

                    @if($item->foto)

                        <img src="{{ asset('storage/' . $item->foto) }}"
                             class="img-staf"
                             alt="{{ $item->nama }}">

                    @else

                        <div class="avatar-placeholder img-staf d-flex align-items-center justify-content-center">
                            <i class="fas fa-user fa-2x text-muted"></i>
                        </div>

                    @endif

                </div>

                <h5 class="name-text" style="font-size:1rem;">
                    {{ $item->nama }}
                </h5>

                <p class="jabatan-text" style="font-size:0.75rem; margin-bottom:0;">
                    {{ $item->jabatan }}
                </p>

            </div>

            @endforeach

        </div>

        @endif


        {{-- FOOTER --}}
        <div class="mt-5 pt-5 text-center">

            <div class="d-inline-flex flex-column flex-md-row gap-3">

                <div class="px-4 py-2 rounded-pill bg-white border shadow-sm">
                    <small class="text-muted fw-bold">
                        TOTAL PERSONEL
                    </small>

                    <span class="ms-2 fw-800 text-success">
                        {{ $strukturs->count() }} Orang
                    </span>
                </div>

                <div class="px-4 py-2 rounded-pill bg-white border shadow-sm">
                    <small class="text-muted fw-bold">
                        UPDATE TERAKHIR
                    </small>

                    <span class="ms-2 fw-800 text-warning">
                        {{ date('Y') }}
                    </span>
                </div>

            </div>

        </div>

    </div>
</div>

@endsection


{{-- JS --}}
@push('scripts')
<script src="{{ asset('assets/js/struktur.js') }}"></script>
@endpush
```
