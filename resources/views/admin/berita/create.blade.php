{{-- resources/views/admin/berita/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Tambah Berita')

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

    /* ── Breadcrumb ── */
    .breadcrumb {
        display: flex; align-items: center; gap: .4rem;
        font-size: .78rem; color: var(--muted); margin-bottom: 1.5rem;
    }

    .breadcrumb a { color: var(--navy-mid); text-decoration: none; font-weight: 500; }
    .breadcrumb a:hover { text-decoration: underline; }
    .breadcrumb svg { width: 12px; height: 12px; }

    /* ── Header ── */
    .brt-header {
        display: flex; align-items: flex-end;
        justify-content: space-between;
        gap: 1.5rem; margin-bottom: 2rem; flex-wrap: wrap;
    }

    .brt-header-left { display: flex; align-items: center; gap: 1rem; }

    .brt-header-icon {
        width: 52px; height: 52px; background: var(--navy);
        border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0; box-shadow: 0 4px 14px rgba(26,39,68,.28);
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

    /* ── Layout ── */
    .form-layout {
        display: grid;
        grid-template-columns: 1fr 320px;
        gap: 1.5rem;
        align-items: start;
    }

    @media (max-width: 900px) {
        .form-layout { grid-template-columns: 1fr; }
    }

    /* ── Cards ── */
    .form-card {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 16px;
        box-shadow: 0 2px 16px rgba(0,0,0,.05);
        overflow: hidden;
    }

    .card-head {
        padding: 1rem 1.5rem;
        border-bottom: 1px solid var(--surface);
        display: flex; align-items: center; gap: .55rem;
    }

    .card-head-icon {
        width: 28px; height: 28px;
        background: var(--sky); border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }

    .card-head-icon svg { width: 14px; height: 14px; color: var(--navy); }

    .card-head-title {
        font-size: .79rem; font-weight: 700;
        color: var(--navy); text-transform: uppercase; letter-spacing: .06em;
    }

    .card-body { padding: 1.25rem 1.5rem; }

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

    /* ── Dropzone ── */
    .dropzone {
        position: relative;
        border: 2px dashed var(--border);
        border-radius: 12px; padding: 1.75rem;
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
        width: 46px; height: 46px; background: var(--white);
        border: 1.5px solid var(--border); border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto .65rem;
    }

    .dz-icon svg { width: 20px; height: 20px; color: var(--muted); }
    .dropzone p  { font-size: .82rem; color: var(--muted); margin: 0; }
    .dz-link     { color: var(--navy-lt); font-weight: 600; }
    .dz-hint     { font-size: .72rem; color: #b0bad0; margin-top: .25rem; }

    /* ── Preview ── */
    .img-preview { display: none; margin-top: 1rem; }

    .img-preview-inner {
        border-radius: 10px; overflow: hidden;
        border: 1.5px solid var(--border);
        position: relative;
    }

    .img-preview img {
        width: 100%; max-height: 200px;
        object-fit: cover; display: block;
    }

    .img-preview-overlay {
        position: absolute; bottom: 0; left: 0; right: 0;
        background: linear-gradient(transparent, rgba(0,0,0,.55));
        padding: .6rem .75rem;
        display: flex; justify-content: space-between; align-items: center;
    }

    .img-preview-label { font-size: .73rem; color: rgba(255,255,255,.85); font-weight: 500; }

    .btn-remove-img {
        font-size: .72rem; color: #fca5a5;
        background: none; border: none; cursor: pointer; padding: 0;
        font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 600;
        text-decoration: underline;
    }

    .btn-remove-img:hover { color: var(--white); }

    /* ── Status select visual ── */
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
        border-color: var(--navy);
        background: var(--sky);
        color: var(--navy);
    }

    .status-opt input { display: none; }

    .status-dot { width: 8px; height: 8px; border-radius: 50%; }
    .status-dot.publish { background: #22c55e; }
    .status-dot.draft   { background: var(--amber); }

    /* ── Form footer ── */
    .form-footer {
        padding: 1rem 1.5rem;
        background: var(--surface); border-top: 1px solid var(--border);
        display: flex; justify-content: flex-end; gap: .75rem;
    }

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
        padding: .6rem 1.4rem; background: var(--navy);
        border: none; border-radius: 9px;
        font-size: .83rem; font-weight: 700;
        color: var(--white); cursor: pointer;
        font-family: 'Plus Jakarta Sans', sans-serif;
        box-shadow: 0 4px 12px rgba(26,39,68,.25);
        transition: background .15s, transform .1s;
    }

    .btn-submit:hover { background: var(--navy-lt); transform: translateY(-1px); }
    .btn-submit svg   { width: 15px; height: 15px; }

    /* Char counter */
    .char-row {
        display: flex; justify-content: space-between;
        align-items: center; margin-top: .3rem;
    }

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
            <span>Tambah Berita</span>
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
                    <h1>Tambah Berita</h1>
                    <p>Tulis dan publikasikan artikel berita baru</p>
                </div>
            </div>
            <a href="{{ route('admin.berita.index') }}" class="btn-back">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
        </div>

        <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data" id="mainForm">
            @csrf

            <div class="form-layout">

                {{-- ── Main column ── --}}
                <div>
                    {{-- Konten --}}
                    <div class="form-card" style="margin-bottom:1.25rem;">
                        <div class="card-head">
                            <div class="card-head-icon">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <span class="card-head-title">Konten Berita</span>
                        </div>
                        <div class="card-body">
                            <div class="field">
                                <label>Judul Berita <span class="req">*</span></label>
                                <input type="text"
                                       name="judul"
                                       id="judul"
                                       value="{{ old('judul') }}"
                                       placeholder="Masukkan judul berita yang menarik"
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
                                          oninput="countChars(this,'isi-count')">{{ old('isi') }}</textarea>
                                <div class="char-row">
                                    @error('isi')
                                        <div class="err-msg">{{ $message }}</div>
                                    @else
                                        <span class="hint">Gunakan paragraf yang jelas dan informatif</span>
                                    @enderror
                                    <span class="char-count" id="isi-count">0 karakter</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Gambar --}}
                    <div class="form-card">
                        <div class="card-head">
                            <div class="card-head-icon">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <span class="card-head-title">Gambar Sampul</span>
                        </div>
                        <div class="card-body">
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
                                        <span class="img-preview-label">Preview gambar sampul</span>
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
                </div>

                {{-- ── Sidebar column ── --}}
                <div>
                    <div class="form-card">
                        <div class="card-head">
                            <div class="card-head-icon">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <span class="card-head-title">Pengaturan</span>
                        </div>

                        <div class="card-body">
                            <div class="field">
                                <label>Status Publikasi</label>
                                <div class="status-options">
                                    <label class="status-opt">
                                        <input type="radio" name="status" value="publish"
                                               {{ old('status','publish') == 'publish' ? 'checked' : '' }}>
                                        <span class="status-dot publish"></span>
                                        Publish
                                    </label>
                                    <label class="status-opt">
                                        <input type="radio" name="status" value="draft"
                                               {{ old('status') == 'draft' ? 'checked' : '' }}>
                                        <span class="status-dot draft"></span>
                                        Draft
                                    </label>
                                </div>
                                @error('status')
                                    <div class="err-msg">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-footer">
                            <a href="{{ route('admin.berita.index') }}" class="btn-cancel">Batal</a>
                            <button type="submit" class="btn-submit">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                </svg>
                                Simpan
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </form>

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

function countChars(el, countId) {
    const len = el.value.length;
    document.getElementById(countId).textContent = len.toLocaleString() + ' karakter';
}

// Init char counts
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