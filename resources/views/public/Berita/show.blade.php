{{-- resources/views/public/berita/show.blade.php --}}
@extends('layouts.appi')

@section('title', $berita->judul . ' - DP3A Tolikara')
@section('meta_description', Str::limit(strip_tags($berita->isi), 150))
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/beritashow.css') }}">
@endpush

@section('content')


<div class="public-wrap">
    {{-- Hero Section --}}
    <div class="hero-detail">
        <div style="max-width: 1200px; margin: 0 auto;">
            <div class="breadcrumb-detail">
                <a href="{{ url('/') }}">Beranda</a>
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <a href="{{ route('public.berita.index') }}">Berita</a>
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span>{{ Str::limit($berita->judul, 50) }}</span>
            </div>
            <h1>{{ $berita->judul }}</h1>
            <div class="hero-meta">
                <span>
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    {{ $berita->created_at->format('d F Y') }}
                </span>
                <span>
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    {{ $berita->penulis }}
                </span>
                <span>
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    {{ number_format($berita->dibaca) }} dibaca
                </span>
                <span class="status-badge {{ $berita->status }}">
                    @if($berita->status == 'publish')
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Published
                    @else
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                        </svg>
                        Draft
                    @endif
                </span>
            </div>
        </div>
    </div>

    <div class="detail-container">
        <a href="{{ route('public.berita.index') }}" class="back-button">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Daftar Berita
        </a>

        <div class="detail-layout">
            {{-- Main Content --}}
            <div class="content-card">
                @if($berita->gambar)
                    <img src="{{ asset('storage/' . $berita->gambar) }}" 
                         alt="{{ $berita->judul }}"
                         class="featured-image">
                @endif

                <div class="content-body">
                    <div class="berita-content">
                        {!! nl2br(e($berita->isi)) !!}
                    </div>

                    <div class="share-section">
                        <div>
                            <span class="share-label">Bagikan artikel ini:</span>
                        </div>
                        <div class="share-buttons">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" 
                               target="_blank" class="share-btn">
                                <svg fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.879V14.89h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.989C18.343 21.129 22 16.99 22 12z"/>
                                </svg>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($berita->judul) }}" 
                               target="_blank" class="share-btn">
                                <svg fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                                </svg>
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($berita->judul . ' - ' . request()->fullUrl()) }}" 
                               target="_blank" class="share-btn">
                                <svg fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.588 2.014.896 3.13.896h.003c3.18 0 5.767-2.586 5.768-5.766.001-3.18-2.585-5.768-5.765-5.768zm3.392 8.244c-.144.405-.837.775-1.17.824-.266.04-.555.058-.856-.075-.252-.11-.714-.28-1.154-.504-.584-.298-1.255-.646-1.758-1.078-.503-.432-.94-.94-1.233-1.478-.24-.44-.37-.847-.37-1.265 0-.48.18-.808.444-1.09.224-.238.49-.342.664-.424.1-.046.192-.058.27-.058.08 0 .146.007.21.068.09.082.28.28.414.5.134.22.27.47.375.717.036.083.056.172.024.268-.032.096-.052.156-.104.244-.052.087-.104.156-.161.226-.054.066-.108.13-.164.192-.05.054-.102.112-.044.208.216.36.5.666.872.928.296.21.622.35.914.454.125.044.2.06.28.06.086 0 .14-.02.188-.078.072-.088.154-.214.23-.34.076-.126.151-.212.216-.27.064-.058.13-.088.216-.06.086.03.554.26.648.373.094.112.094.208.066.324z"/>
                                </svg>
                            </a>
                            <button onclick="copyToClipboard()" class="share-btn" id="copyBtn">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div>
                @if($beritaTerkait->count() > 0)
                <div class="sidebar-card">
                    <div class="sidebar-header">
                        <h3>
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Berita Terkait
                        </h3>
                    </div>
                    <div class="sidebar-body">
                        @foreach($beritaTerkait as $item)
                        <div class="related-item">
                            @if($item->gambar)
                                <img src="{{ asset('storage/' . $item->gambar) }}" 
                                     alt="{{ $item->judul }}"
                                     class="related-img">
                            @else
                                <div class="related-img-placeholder">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            @endif
                            <div class="related-content">
                                <div class="related-title">
                                    <a href="{{ route('public.berita.show', $item->id) }}">
                                        {{ Str::limit($item->judul, 50) }}
                                    </a>
                                </div>
                                <div class="related-meta">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    {{ $item->created_at->format('d M Y') }}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <div class="sidebar-card">
                    <div class="sidebar-header">
                        <h3>
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            Informasi Lainnya
                        </h3>
                    </div>
                    <div class="sidebar-body">
                        <div class="related-item" style="border-bottom: none;">
                            <div class="related-img-placeholder">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div class="related-content">
                                <div class="related-title">Butuh Bantuan?</div>
                                <div class="related-meta">
                                    <a href="{{ url('/contact') }}" style="color: var(--navy);">Hubungi Kami →</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function copyToClipboard() {
    const url = window.location.href;
    navigator.clipboard.writeText(url).then(() => {
        const btn = document.getElementById('copyBtn');
        const originalHtml = btn.innerHTML;
        btn.innerHTML = '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>';
        setTimeout(() => {
            btn.innerHTML = originalHtml;
        }, 2000);
    }).catch(() => {
        alert('Gagal menyalin link');
    });
}
</script>
@endsection