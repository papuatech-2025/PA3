{{-- resources/views/admin/berita/edit.blade.php --}}
@extends('layouts.app')

@section('title', 'Edit Berita')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Lora:ital,wght@0,400;0,600;1,400&display=swap');

    :root {
        --navy:      #1a2744;
        --navy-mid:  #243460;
        --navy-lt:   #2e4080;
        --sky:       #eef2ff;
        --amber:     #d97706;
        --amber-lt:  #fef3c7;
        --ink:       #1e2535;
        --muted:     #6b7280;
        --border:    #e2e8f0;
        --white:     #ffffff;
        --surface:   #f8fafd;
        --danger:    #dc2626;
        --danger-lt: #fef2f2;
        --success:   #16a34a;
    }

    .brt-wrap * { font-family: 'Plus Jakarta Sans', sans-serif; }

    .brt-wrap {
        background: var(--surface);
        min-height: 100vh;
        padding: 2rem 1.5rem 3rem;
    }

    .breadcrumb {
        display: flex; align-items: center; gap: .4rem;
        font-size: .78rem; color: var(--muted); margin-bottom: 1.5rem;
    }

    .breadcrumb a { color: var(--navy-mid); text-decoration: none; font-weight: 500; }
    .breadcrumb a:hover { text-decoration: underline; }
    .breadcrumb svg { width: 12px; height: 12px; }

    .brt-header {
        display: flex; align-items: flex-end;
        justify-content: space-between;
        gap: 1.5rem; margin-bottom: 2rem; flex-wrap: wrap;
    }

    .brt-header-left { display: flex; align-items: center; gap: 1rem; }

    .brt-header-icon {
        width: 52px; height: 52px; background: var(--amber);
        border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0; box-shadow: 0 4px 14px rgba(217,119,6,.3);
    }

    .brt-header-icon svg { width: 24px; height: 24px; color: var(--white); }

    .brt-header h1 {
        font-family: 'Lora', serif;
        font-size: 1.7rem; font-weight: 700;
        color: var(--ink); line-height: 1.2; margin: 0;
    }

    .brt-header p { font-size: .82rem; color: var(--muted); margin: .2rem 0 0; }

    .btn-back {
        display: inline-flex; align-items: center; gap: .4rem;
        padding: .55rem 1.1rem;
        background: var(--white); border: 1px solid var(--border);
        border-radius: 9px; font-size: .82rem; font-weight: 600;
        color: var(--ink); text-decoration: none; transition: all .15s;
        white-space: nowrap;
    }

    .btn-back:hover { background: var(--sky); border-color: var(--navy-lt); color: var(--navy); }
    .btn-back svg   { width: 14px; height: 14px; }

    /* ── Article banner ── */
    .article-banner {
        display: flex; align-items: center; gap: 1.1rem;
        background: linear-gradient(135deg, var(--navy) 0%, var(--navy-lt) 100%);
        border-radius: 14px 14px 0 0;
        padding: 1.4rem 2rem; color: var(--white);
        margin-bottom: 0;
    }

    .article-thumb {
        width: 60px; height: 60px; border-radius: 10px;
        object-fit: cover; border: 2px solid rgba(255,255,255,.3);
        flex-shrink: 0;
    }

    .article-thumb-placeholder {
        width: 60px; height: 60px; border-radius: 10px;
        background: rgba(255,255,255,.12);
        border: 2px dashed rgba(255,255,255,.3);
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }

    .article-thumb-placeholder svg { width: 24px; height: 24px; color: rgba(255,255,255,.5); }

    .article-banner-title { font-size: 1rem; font-weight: 700; margin: 0; line-height: 1.3; }
    .article-banner-meta  { font-size: .78rem; color: rgba(255,255,255,.65); margin: .2rem 0 0; }

    .banner-badge {
        margin-left: auto; flex-shrink: 0;
        padding: .3rem .85rem; border-radius: 20px;
        font-size: .72rem; font-weight: 700;
        background: rgba(255,255,255,.15);
        border: 1px solid rgba(255,255,255,.22);
        white-space: nowrap;
    }

    /* ── Layout ── */
    .form-wrapper {
        border-radius: 0 0 16px 16px;
        border: 1px solid var(--border);
        border-top: none;
        background: var(--white);
        box-shadow: 0 4px 24px rgba(0,0,0,.07);
        overflow: hidden;
    }

    .form-layout {
        display: grid;
        grid-template-columns: 1fr 320px;
        gap: 0;
    }

    .form-main { padding: 1.5rem; border-right: 1px solid var(--border); }
    .form-side  { padding: 1.5rem; }

    @media (max-width: 900px) {
        .form-layout { grid-template-columns: 1fr; }
        .form-main { border-right: none; border-bottom: 1px solid var(--border); }
    }

    /* ── Section title ── */
    .section-title {
        display: flex; align-items: center; gap: .55rem;
        font-size: .78rem; font-weight: 700;
        color: var(--navy); text-transform: uppercase; letter-spacing: .06em;
        margin-bottom: 1.1rem;
    }

    .section-title::after { content: ''; flex: 1; height: 1px; background: var(--border); }

    .section-icon {
        width: 26px; height: 26px; background: var(--sky);
        border-radius: 7px;
        display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    }

    .section-icon svg { width: 13px; height: 13px; color: var(--navy); }

    /* ── Fields ── */
    .field { margin-bottom: 1.1rem; }
    .field:last-child { margin-bottom: 0; }

    .field label {
        display: block; font-size: .79rem; font-weight: 700;
        color: var(--ink); margin-bottom: .45rem;
    }

    .field label .req { color: var(--danger); margin-left: .15rem; }

    .field input,
    .field select,
    .field textarea {
        width: 100%; padding: .62rem .9rem;
        border: 1.5px solid var(--border); border-radius: 9px;
        font-size: .85rem; color: var(--ink); background: var(--white);
        font-family: 'Plus Jakarta Sans', sans-serif;
        transition: border-color .15s, box-shadow .15s;
        outline: none; box-sizing: border-box;
    }

    .field input:focus,
    .field select:focus,
    .field textarea:focus {
        border-color: var(--navy-lt);
        box-shadow: 0 0 0 3px rgba(46,64,128,.1);
    }

    .field input.error,
    .field textarea.error { border-color: var(--danger); }

    .field textarea { resize: vertical; min-height: 260px; line-height: 1.6; }

    .field .hint   { font-size: .73rem; color: var(--muted); margin-top: .3rem; }
    .field .err-msg { font-size: .73rem; color: var(--danger); margin-top: .3rem; }

    /* ── Current image box ── */
    .current-img-box {
        border-radius: 10px; overflow: hidden;
        border: 1.5px solid #fcd34d;
        margin-bottom: .85rem; position: relative;
    }

    .current-img-box img {
        width: 100%; max-height: 180px;
        object-fit: cover; display: block;
    }

    .current-img-overlay {
        position: absolute; bottom: 0; left: 0; right: 0;
        background: linear-gradient(transparent, rgba(0,0,0,.6));
        padding: .65rem .85rem;
        display: flex; justify-content: space-between; align-items: center;
    }

    .current-label { font-size: .73rem; color: rgba(255,255,255,.85); font-weight: 500; }

    .btn-remove-current {
        font-size: .72rem; color: #fca5a5; font-weight: 600;
        background: none; border: none; cursor: pointer; padding: 0;
        font-family: 'Plus Jakarta Sans', sans-serif; text-decoration: underline;
    }

    .btn-remove-current:hover { color: var(--white); }

    /* ── Dropzone ── */
    .dropzone {
        position: relative; border: 2px dashed var(--border);
        border-radius: 12px; padding: 1.5rem;
        text-align: center; cursor: pointer;
        background: var(--surface);
        transition: border-color .2s, background .2s;
    }

    .dropzone:hover, .dropzone.drag-over {
        border-color: var(--navy-lt); background: var(--sky);
    }

    .dropzone input[type="file"] {
        position: absolute; inset: 0;
        width: 100%; height: 100%;
        opacity: 0; cursor: pointer;
        border: none !important; box-shadow: none !important;
    }

    .dz-icon {
        width: 40px; height: 40px; background: var(--white);
        border: 1.5px solid var(--border); border-radius: 9px;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto .55rem;
    }

    .dz-icon svg { width: 18px; height: 18px; color: var(--muted); }
    .dropzone p  { font-size: .8rem; color: var(--muted); margin: 0; }
    .dz-link     { color: var(--navy-lt); font-weight: 600; }
    .dz-hint     { font-size: .72rem; color: #b0bad0; margin-top: .2rem; }

    /* ── New preview ── */
    .img-preview { display: none; margin-top: .85rem; }

    .img-preview-inner {
        border-radius: 10px; overflow: hidden;
        border: 1.5px solid var(--border); position: relative;
    }

    .img-preview img { width: 100%; max-height: 160px; object-fit: cover; display: block; }

    .img-preview-overlay {
        position: absolute; bottom: 0; left: 0; right: 0;
        background: linear-gradient(transparent, rgba(0,0,0,.55));
        padding: .55rem .75rem;
        display: flex; justify-content: space-between; align-items: center;
    }

    .img-preview-label { font-size: .72rem; color: rgba(255,255,255,.85); font-weight: 500; }

    .btn-remove-img {
        font-size: .72rem; color: #fca5a5;
        background: none; border: none; cursor: pointer; padding: 0;
        font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 600;
        text-decoration: underline;
    }

    /* ── Status options ── */
    .status-options { display: flex; gap: .65rem; }

    .status-opt {
        flex: 1; padding: .65rem 1rem;
        border: 1.5px solid var(--border);
        border-radius: 9px; cursor: pointer;
        text-align: center; transition: all .15s;
        font-size: .8rem; font-weight: 600; color: var(--muted);
        background: var(--white);
        display: flex; align-items: center; justify-content: center; gap: .4rem;
    }

    .status-opt:has(input:checked) {
        border-color: var(--navy); background: var(--sky); color: var(--navy);
    }

    .status-opt input { display: none; }
    .status-dot { width: 8px; height: 8px; border-radius: 50%; }
    .status-dot.publish { background: #22c55e; }
    .status-dot.draft   { background: var(--amber); }

    /* ── Meta info ── */
    .meta-row {
        display: flex; align-items: center; gap: .5rem;
        padding: .7rem .85rem;
        background: var(--surface); border: 1px solid var(--border);
        border-radius: 9px; margin-bottom: .75rem;
        font-size: .77rem; color: var(--muted);
    }

    .meta-row svg { width: 13px; height: 13px; flex-shrink: 0; }
    .meta-row strong { color: var(--ink); font-weight: 600; }

    /* ── Footer ── */
    .form-footer-bar {
        padding: 1rem 1.5rem;
        background: var(--surface); border-top: 1px solid var(--border);
        display: flex; justify-content: space-between; align-items: center;
        flex-wrap: wrap; gap: .5rem;
    }

    .footer-meta { font-size: .74rem; color: var(--muted); display: flex; align-items: center; gap: .35rem; }
    .footer-meta svg { width: 12px; height: 12px; }
    .footer-actions { display: flex; gap: .75rem; }

    .btn-cancel {
        padding: .6rem 1.2rem;
        background: var(--white); border: 1.5px solid var(--border);
        border-radius: 9px; font-size: .83rem; font-weight: 600;
        color: var(--ink); text-decoration: none; cursor: pointer;
        font-family: 'Plus Jakarta Sans', sans-serif; transition: all .15s;
    }

    .btn-cancel:hover { background: #f1f5f9; }

    .btn-submit {
        display: inline-flex; align-items: center; gap: .4rem;
        padding: .6rem 1.4rem; background: var(--amber);
        border: none; border-radius: 9px;
        font-size: .83rem; font-weight: 700;
        color: var(--white); cursor: pointer;
        font-family: 'Plus Jakarta Sans', sans-serif;
        box-shadow: 0 4px 12px rgba(217,119,6,.3);
        transition: background .15s, transform .1s;
    }

    .btn-submit:hover { background: #b45309; transform: translateY(-1px); }
    .btn-submit svg   { width: 15px; height: 15px; }

    /* Char counter */
    .char-row { display: flex; justify-content: space-between; align-items: center; margin-top: .3rem; }
    .char-count { font-size: .72rem; color: var(--muted); }
</style>

<div class="brt-wrap">
    <div style="max-width:1050px;margin:0 auto;">

        {{-- Breadcrumb --}}
        <div class="breadcrumb">
            <a href="{{ route('admin.berita.index') }}">Manajemen Berita</a>
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span>Edit: {{ Str::limit($berita->judul, 40) }}</span>
        </div>

        {{-- Header --}}
        <div class="brt-header">
            <div class="brt-header-left">
                <div class="brt-header-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                </div>
                <div>
                    <h1>Edit Berita</h1>
                    <p>Perbarui konten artikel berita</p>
                </div>
            </div>
            <a href="{{ route('admin.berita.index') }}" class="btn-back">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
        </div>

        {{-- Outer wrapper with banner --}}
        <div style="border-radius:16px;overflow:hidden;box-shadow:0 4px 24px rgba(0,0,0,.08);">

            {{-- Article Banner --}}
            <div class="article-banner">
                @if($berita->gambar)
                    <img src="{{ asset('storage/' . $berita->gambar) }}"
                         alt="{{ $berita->judul }}"
                         class="article-thumb">
                @else
                    <div class="article-thumb-placeholder">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                @endif
                <div>
                    <p class="article-banner-title">{{ Str::limit($berita->judul, 60) }}</p>
                    <p class="article-banner-meta">{{ $berita->penulis }} &middot; {{ $berita->created_at->format('d M Y') }}</p>
                </div>
                <span class="banner-badge">
                    {{ $berita->status == 'publish' ? '● Publish' : '○ Draft' }}
                </span>
            </div>

            {{-- Form wrapper --}}
            <div class="form-wrapper">
                <form action="{{ route('admin.berita.update', $berita->id) }}" method="POST"
                      enctype="multipart/form-data" id="mainForm">
                    @csrf
                    @method('PUT')

                    <div class="form-layout">

                        {{-- Main --}}
                        <div class="form-main">

                            <div class="section-title">
                                <div class="section-icon">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                                Konten Berita
                            </div>

                            <div class="field">
                                <label>Judul Berita <span class="req">*</span></label>
                                <input type="text"
                                       name="judul"
                                       id="judul"
                                       value="{{ old('judul', $berita->judul) }}"
                                       placeholder="Masukkan judul berita"
                                       class="{{ $errors->has('judul') ? 'error' : '' }}"
                                       oninput="countChars(this,'judul-count')">
                                <div class="char-row">
                                    @error('judul')
                                        <div class="err-msg">{{ $message }}</div>
                                    @else
                                        <span></span>
                                    @enderror
                                    <span class="char-count" id="judul-count">0 karakter</span>
                                </div>
                            </div>

                            <div class="field">
                                <label>Isi Berita <span class="req">*</span></label>
                                <textarea name="isi"
                                          id="isi"
                                          placeholder="Tulis isi berita di sini..."
                                          class="{{ $errors->has('isi') ? 'error' : '' }}"
                                          oninput="countChars(this,'isi-count')">{{ old('isi', $berita->isi) }}</textarea>
                                <div class="char-row">
                                    @error('isi')
                                        <div class="err-msg">{{ $message }}</div>
                                    @else
                                        <span></span>
                                    @enderror
                                    <span class="char-count" id="isi-count">0 karakter</span>
                                </div>
                            </div>

                            {{-- Gambar --}}
                            <div style="margin-top:1.5rem;">
                                <div class="section-title">
                                    <div class="section-icon">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    Gambar Sampul
                                </div>

                                @if($berita->gambar)
                                <div class="current-img-box" id="currentImage">
                                    <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Current">
                                    <div class="current-img-overlay">
                                        <span class="current-label">Gambar saat ini</span>
                                        <button type="button" class="btn-remove-current" onclick="removeImage()">
                                            Hapus gambar
                                        </button>
                                    </div>
                                </div>
                                @endif

                                <div class="dropzone" id="dropzone">
                                    <input type="file" name="gambar" id="gambar"
                                           accept="image/*" onchange="previewImage(this)">
                                    <div class="dz-icon">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                  d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                        </svg>
                                    </div>
                                    <p><span class="dz-link">Klik untuk upload</span> atau seret &amp; lepas</p>
                                    <p class="dz-hint">PNG, JPG, JPEG — Maks. 2 MB</p>
                                </div>

                                <div class="img-preview" id="imagePreview">
                                    <div class="img-preview-inner">
                                        <img id="preview" src="" alt="Preview">
                                        <div class="img-preview-overlay">
                                            <span class="img-preview-label">Preview gambar baru</span>
                                            <button type="button" class="btn-remove-img" onclick="removePreview()">
                                                Ganti foto
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                @error('gambar')
                                    <div class="err-msg" style="margin-top:.5rem;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Sidebar --}}
                        <div class="form-side">

                            <div class="section-title">
                                <div class="section-icon">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                Info Artikel
                            </div>

                            <div class="meta-row">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                Penulis: <strong>{{ $berita->penulis }}</strong>
                            </div>

                            <div class="meta-row">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                Dibaca: <strong>{{ number_format($berita->dibaca) }}x</strong>
                            </div>

                            <div class="meta-row">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                Dibuat: <strong>{{ $berita->created_at->format('d M Y') }}</strong>
                            </div>

                            <div class="field" style="margin-top:1.25rem;">
                                <label>Status Publikasi</label>
                                <div class="status-options">
                                    <label class="status-opt">
                                        <input type="radio" name="status" value="publish"
                                               {{ old('status', $berita->status) == 'publish' ? 'checked' : '' }}>
                                        <span class="status-dot publish"></span>
                                        Publish
                                    </label>
                                    <label class="status-opt">
                                        <input type="radio" name="status" value="draft"
                                               {{ old('status', $berita->status) == 'draft' ? 'checked' : '' }}>
                                        <span class="status-dot draft"></span>
                                        Draft
                                    </label>
                                </div>
                            </div>

                        </div>
                    </div>

                    {{-- Footer --}}
                    <div class="form-footer-bar">
                        <div class="footer-meta">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Terakhir diperbarui: {{ $berita->updated_at?->diffForHumans() ?? '-' }}
                        </div>
                        <div class="footer-actions">
                            <a href="{{ route('admin.berita.index') }}" class="btn-cancel">Batal</a>
                            <button type="submit" class="btn-submit">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                          d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                </svg>
                                Simpan Perubahan
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>

<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('preview').src = e.target.result;
            document.getElementById('imagePreview').style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function removePreview() {
    document.getElementById('gambar').value = '';
    document.getElementById('imagePreview').style.display = 'none';
}

function removeImage() {
    if (confirm('Hapus gambar ini? Perubahan berlaku setelah klik Simpan.')) {
        const form = document.getElementById('mainForm');
        const hidden = document.createElement('input');
        hidden.type = 'hidden';
        hidden.name = 'remove_gambar';
        hidden.value = '1';
        form.appendChild(hidden);
        document.getElementById('currentImage').style.display = 'none';
    }
}

function countChars(el, countId) {
    document.getElementById(countId).textContent = el.value.length.toLocaleString() + ' karakter';
}

window.addEventListener('DOMContentLoaded', () => {
    const judul = document.getElementById('judul');
    const isi   = document.getElementById('isi');
    if (judul.value) countChars(judul, 'judul-count');
    if (isi.value)   countChars(isi, 'isi-count');
});

const dz = document.getElementById('dropzone');
dz.addEventListener('dragover',  e => { e.preventDefault(); dz.classList.add('drag-over'); });
dz.addEventListener('dragleave', e => { e.preventDefault(); dz.classList.remove('drag-over'); });
dz.addEventListener('drop', e => {
    e.preventDefault(); dz.classList.remove('drag-over');
    const files = e.dataTransfer.files;
    if (files.length > 0) {
        document.getElementById('gambar').files = files;
        previewImage(document.getElementById('gambar'));
    }
});
</script>
@endsection