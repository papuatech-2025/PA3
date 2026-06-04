{{-- resources/views/admin/struktur/create.blade.php (Dan Edit dengan penyesuaian) --}}
@extends('layouts.app')

@section('title', isset($struktur) ? 'Edit Anggota' : 'Tambah Anggota')

@section('content')
<style>
    .form-container {
        font-family: 'Plus Jakarta Sans', sans-serif;
        max-width: 900px;
        margin: 0 auto;
        padding: 2rem 1rem;
    }

    .form-card {
        background: white;
        border-radius: 24px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .form-header-banner {
        background: linear-gradient(135deg, #1a4731 0%, #2d7a54 100%);
        padding: 2rem;
        color: white;
    }

    .form-body { padding: 2.5rem; }

    .form-label {
        font-weight: 700;
        font-size: 0.85rem;
        color: #1e293b;
        margin-bottom: 0.5rem;
        display: block;
    }

    .form-control, .form-select {
        border-radius: 12px;
        padding: 0.75rem 1rem;
        border: 1.5px solid #e2e8f0;
        font-size: 0.9rem;
        transition: all 0.2s;
    }

    .form-control:focus {
        border-color: #1a4731;
        box-shadow: 0 0 0 4px rgba(26, 71, 49, 0.1);
    }

    /* File Upload Area */
    .upload-zone {
        border: 2px dashed #cbd5e1;
        border-radius: 16px;
        padding: 2rem;
        text-align: center;
        background: #f8fafc;
        cursor: pointer;
        transition: all 0.2s;
    }

    .upload-zone:hover { border-color: #1a4731; background: #f0fdf4; }

    .preview-container {
        width: 120px; height: 120px;
        margin: 0 auto 1rem;
        border-radius: 50%;
        overflow: hidden;
        border: 4px solid white;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
</style>

<div class="form-container">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.struktur.index') }}" class="text-decoration-none text-muted">Struktur</a></li>
            <li class="breadcrumb-item active fw-bold">{{ isset($struktur) ? 'Edit' : 'Tambah' }}</li>
        </ol>
    </nav>

    <div class="form-card">
        <div class="form-header-banner d-flex align-items-center gap-4">
            @if(isset($struktur))
                <div class="preview-container mb-0">
                    <img src="{{ $struktur->foto ? asset('storage/'.$struktur->foto) : 'https://ui-avatars.com/api/?name='.$struktur->nama }}" style="width:100%;height:100%;object-fit:cover">
                </div>
                <div>
                    <h2 class="h4 fw-bold mb-1">{{ $struktur->nama }}</h2>
                    <p class="mb-0 opacity-75 small">Perbarui informasi jabatan dan profil anggota</p>
                </div>
            @else
                <div class="bg-white bg-opacity-20 p-3 rounded-circle">
                    <i class="fas fa-user-plus fa-2x"></i>
                </div>
                <div>
                    <h2 class="h4 fw-bold mb-1">Tambah Anggota Baru</h2>
                    <p class="mb-0 opacity-75 small">Lengkapi data untuk menambahkan ke struktur organisasi</p>
                </div>
            @endif
        </div>

        <form action="{{ isset($struktur) ? route('admin.struktur.update', $struktur->id) : route('admin.struktur.store') }}" method="POST" enctype="multipart/form-data" class="form-body">
            @csrf
            @if(isset($struktur)) @method('PUT') @endif

            <div class="row g-4">
                <div class="col-md-7">
                    <div class="mb-4">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $struktur->nama ?? '') }}" placeholder="Contoh: John Doe, S.Kom">
                        @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Jabatan</label>
                        <input type="text" name="jabatan" class="form-control @error('jabatan') is-invalid @enderror" value="{{ old('jabatan', $struktur->jabatan ?? '') }}" placeholder="Contoh: Sekretaris Dinas">
                        @error('jabatan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <label class="form-label">Urutan Tampil</label>
                            <input type="number" name="urutan" class="form-control" value="{{ old('urutan', $struktur->urutan ?? 0) }}">
                        </div>
                        <div class="col-6">
                            <label class="form-label">Status</label>
                            <select name="aktif" class="form-select">
                                <option value="1" {{ (old('aktif', $struktur->aktif ?? 1) == 1) ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ (old('aktif', $struktur->aktif ?? 1) == 0) ? 'selected' : '' }}>Nonaktif</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <label class="form-label">Foto Profil</label>
                    <div class="upload-zone" onclick="document.getElementById('fotoInput').click()">
                        <div id="imagePreviewContainer">
                            <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-3"></i>
                            <p class="small text-muted mb-0">Klik untuk unggah foto anggota</p>
                            <p class="text-xs text-muted opacity-50">(Format: JPG, PNG, Max 2MB)</p>
                        </div>
                        <input type="file" name="foto" id="fotoInput" hidden accept="image/*">
                    </div>
                    @error('foto') <div class="text-danger small mt-2">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="mt-5 pt-4 border-top d-flex gap-3">
                <button type="submit" class="btn btn-primary px-5" style="background: #1a4731; border: none; border-radius: 12px; padding: 0.8rem;">
                    <i class="fas fa-save me-2"></i> Simpan Data
                </button>
                <a href="{{ route('admin.struktur.index') }}" class="btn btn-light px-4" style="border-radius: 12px; padding: 0.8rem; border: 1px solid #e2e8f0;">Batal</a>
            </div>
        </form>
    </div>
</div>

<script>
    // Preview Image Script
    document.getElementById('fotoInput').onchange = function (evt) {
        const [file] = this.files
        if (file) {
            const container = document.getElementById('imagePreviewContainer');
            container.innerHTML = `<img src="${URL.createObjectURL(file)}" style="max-width:100%; border-radius:12px; box-shadow:0 4px 6px rgba(0,0,0,0.1)">`;
        }
    }
</script>
@endsection