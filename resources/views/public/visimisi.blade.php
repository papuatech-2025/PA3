@extends('layouts.appi')

@section('title', 'Visi & Misi - DP3A Tolikara')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Lora:ital,wght@0,400;0,600;1,400&display=swap');

    :root {
        --navy:      #1a2744;
        --navy-mid:  #243460;
        --navy-lt:   #2e4080;
        --sky:       #eef2ff;
        --amber:     #d97706;
        --ink:       #1e2535;
        --muted:     #6b7280;
        --border:    #e2e8f0;
        --white:     #ffffff;
        --surface:   #f8fafd;
    }

    .visimisi-wrap * { font-family: 'Plus Jakarta Sans', sans-serif; }

    .visimisi-wrap {
        background: var(--surface);
        min-height: 100vh;
    }

    .hero-visimisi {
        background: linear-gradient(135deg, var(--navy) 0%, var(--navy-lt) 100%);
        padding: 3rem 1.5rem 2.5rem;
        position: relative;
        overflow: hidden;
    }

    .hero-visimisi::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 60px;
        background: var(--surface);
        clip-path: polygon(0 100%, 100% 100%, 100% 0);
    }

    .hero-visimisi h1 {
        font-family: 'Lora', serif;
        font-size: 2.2rem;
        font-weight: 700;
        color: var(--white);
        margin-bottom: 0.75rem;
        text-align: center;
    }

    .hero-visimisi p {
        font-size: 0.9rem;
        color: rgba(255,255,255,0.8);
        text-align: center;
    }

    .breadcrumb-custom {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        font-size: 0.8rem;
        margin-bottom: 1rem;
        flex-wrap: wrap;
    }

    .breadcrumb-custom a {
        color: rgba(255,255,255,0.7);
        text-decoration: none;
    }

    .breadcrumb-custom a:hover {
        color: var(--white);
    }

    .breadcrumb-custom svg {
        width: 12px;
        height: 12px;
        color: rgba(255,255,255,0.5);
    }

    .breadcrumb-custom span {
        color: rgba(255,255,255,0.9);
    }

    .visimisi-container {
        max-width: 1100px;
        margin: 0 auto;
        padding: 2rem 1.5rem 3rem;
    }

    .visi-card, .misi-card {
        background: var(--white);
        border-radius: 20px;
        border: 1px solid var(--border);
        overflow: hidden;
        height: 100%;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .visi-card:hover, .misi-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 30px rgba(0,0,0,0.1);
    }

    .card-header-visi {
        background: linear-gradient(135deg, var(--navy) 0%, var(--navy-mid) 100%);
        padding: 1.25rem 1.5rem;
        text-align: center;
    }

    .card-header-misi {
    background: linear-gradient(135deg, var(--amber) 0%, #b85c00 100%);
        padding: 1.25rem 1.5rem;
        text-align: center;
    }

    .card-header-visi h3, .card-header-misi h3 {
        font-family: 'Lora', serif;
        font-size: 1.4rem;
        font-weight: 700;
        color: var(--white);
        margin: 0;
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
    }

    .card-header-visi h3 svg, .card-header-misi h3 svg {
        width: 24px;
        height: 24px;
    }

    .card-body-visi, .card-body-misi {
        padding: 1.75rem;
        line-height: 1.8;
        font-size: 1rem;
        color: var(--ink);
    }

    .card-body-visi p, .card-body-misi p {
        margin-bottom: 0;
    }

    .divider-custom {
        width: 60px;
        height: 3px;
        background: var(--amber);
        margin: 1rem auto 0;
        border-radius: 4px;
    }

    .empty-state {
        text-align: center;
        padding: 2rem;
    }

    .empty-icon {
        width: 60px;
        height: 60px;
        background: var(--surface);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
    }

    .empty-icon svg {
        width: 28px;
        height: 28px;
        color: var(--muted);
    }

    @media (max-width: 768px) {
        .hero-visimisi h1 {
            font-size: 1.6rem;
        }
        .card-header-visi h3, .card-header-misi h3 {
            font-size: 1.2rem;
        }
        .card-body-visi, .card-body-misi {
            padding: 1.25rem;
            font-size: 0.95rem;
        }
    }
</style>

<div class="visimisi-wrap">
    <div class="hero-visimisi">
        <div style="max-width: 1100px; margin: 0 auto;">
            <div class="breadcrumb-custom">
                <a href="{{ url('/') }}">Beranda</a>
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span>Visi & Misi</span>
            </div>
            <h1>Visi & Misi</h1>
            <p>Dinas Pemberdayaan Perempuan dan Perlindungan Anak Kabupaten Tolikara</p>
        </div>
    </div>

    <div class="visimisi-container">
        @php
            // Pisahkan konten Visi dan Misi jika ada markup khusus
            $isi = $data->isi ?? '';
            $visiContent = '';
            $misiContent = $isi;
            
            // Coba pisahkan berdasarkan heading Visi dan Misi
            if (preg_match('/visi\s*[:|]?/i', $isi)) {
                $parts = preg_split('/misi\s*[:|]?/i', $isi, 2);
                if (count($parts) >= 2) {
                    $visiContent = preg_replace('/visi\s*[:|]?/i', '', $parts[0]);
                    $misiContent = $parts[1];
                }
            }
        @endphp

        <div class="row g-4">
            {{-- Visi Card --}}
            <div class="col-md-6">
                <div class="visi-card">
                    <div class="card-header-visi">
                        <h3>
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            Visi
                        </h3>
                    </div>
                    <div class="card-body-visi">
                        @if($visiContent && trim($visiContent) != '')
                            <p>{!! nl2br(e(trim($visiContent))) !!}</p>
                        @elseif($isi && !$visiContent)
                            <p>{!! nl2br(e($isi)) !!}</p>
                        @else
                            <div class="empty-state">
                                <div class="empty-icon">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                                <p class="text-muted text-center mb-0">Visi akan segera diisi</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Misi Card --}}
            <div class="col-md-6">
                <div class="misi-card">
                    <div class="card-header-misi">
                        <h3>
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                            Misi
                        </h3>
                    </div>
                    <div class="card-body-misi">
                        @if($misiContent && trim($misiContent) != '')
                            {!! nl2br(e(trim($misiContent))) !!}
                        @else
                            <div class="empty-state">
                                <div class="empty-icon">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                                <p class="text-muted text-center mb-0">Misi akan segera diisi</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection