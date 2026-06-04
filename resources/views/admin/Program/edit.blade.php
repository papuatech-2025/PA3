@extends('layouts.app')

@section('title', 'Edit Program')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="mt-4" style="color: #6B0F4B;">
                <i class="bi bi-pencil-square me-2" style="color: #D4145A;"></i>
                Edit Program
            </h1>
            <ol class="breadcrumb mb-0 bg-transparent p-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="color: #D4145A;">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.program.index') }}" style="color: #D4145A;">Program</a></li>
                <li class="breadcrumb-item active">Edit Program</li>
            </ol>
        </div>
        <a href="{{ route('admin.program.index') }}" class="btn btn-secondary rounded-pill px-4">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <form action="{{ route('admin.program.update', $program) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-lg-8">
                        <!-- Nama Program -->
                        <div class="mb-3">
                            <label for="nama_program" class="form-label fw-semibold">
                                Nama Program <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('nama_program') is-invalid @enderror" 
                                   id="nama_program" 
                                   name="nama_program" 
                                   value="{{ old('nama_program', $program->nama_program) }}"
                                   placeholder="Masukkan nama program..."
                                   required>
                            @error('nama_program')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Kategori -->
                        <div class="mb-3">
                            <label for="kategori" class="form-label fw-semibold">
                                Kategori <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('kategori') is-invalid @enderror" id="kategori" name="kategori" required>
                                <option value="">Pilih Kategori</option>
                                <option value="Pemberdayaan" {{ old('kategori', $program->kategori) == 'Pemberdayaan' ? 'selected' : '' }}>Pemberdayaan</option>
                                <option value="Perlindungan" {{ old('kategori', $program->kategori) == 'Perlindungan' ? 'selected' : '' }}>Perlindungan</option>
                                <option value="Kesehatan" {{ old('kategori', $program->kategori) == 'Kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                                <option value="Ekonomi" {{ old('kategori', $program->kategori) == 'Ekonomi' ? 'selected' : '' }}>Ekonomi</option>
                                <option value="Advokasi" {{ old('kategori', $program->kategori) == 'Advokasi' ? 'selected' : '' }}>Advokasi</option>
                            </select>
                            @error('kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Lokasi -->
                        <div class="mb-3">
                            <label for="lokasi" class="form-label fw-semibold">
                                Lokasi
                            </label>
                            <input type="text" 
                                   class="form-control @error('lokasi') is-invalid @enderror" 
                                   id="lokasi" 
                                   name="lokasi" 
                                   value="{{ old('lokasi', $program->lokasi) }}"
                                   placeholder="Contoh: Aula Dinas P3A Karubaga">
                            @error('lokasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label fw-semibold">
                                Deskripsi Program <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                      id="deskripsi" 
                                      name="deskripsi" 
                                      rows="6" 
                                      placeholder="Jelaskan secara detail tentang program ini...">{{ old('deskripsi', $program->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tanggal Mulai & Selesai -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="tanggal_mulai" class="form-label fw-semibold">
                                    Tanggal Mulai
                                </label>
                                <input type="date" 
                                       class="form-control @error('tanggal_mulai') is-invalid @enderror" 
                                       id="tanggal_mulai" 
                                       name="tanggal_mulai" 
                                       value="{{ old('tanggal_mulai', $program->tanggal_mulai ? $program->tanggal_mulai->format('Y-m-d') : '') }}">
                                @error('tanggal_mulai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="tanggal_selesai" class="form-label fw-semibold">
                                    Tanggal Selesai
                                </label>
                                <input type="date" 
                                       class="form-control @error('tanggal_selesai') is-invalid @enderror" 
                                       id="tanggal_selesai" 
                                       name="tanggal_selesai" 
                                       value="{{ old('tanggal_selesai', $program->tanggal_selesai ? $program->tanggal_selesai->format('Y-m-d') : '') }}">
                                @error('tanggal_selesai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Gambar -->
                        <div class="mb-3">
                            <label for="gambar" class="form-label fw-semibold">
                                Gambar Program
                            </label>
                            <input type="file" 
                                   class="form-control @error('gambar') is-invalid @enderror" 
                                   id="gambar" 
                                   name="gambar" 
                                   accept="image/*"
                                   onchange="previewImage(this)">
                            @error('gambar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="mt-2">
                                @if($program->gambar)
                                <img id="gambarPreview" 
                                     src="{{ asset('storage/'.$program->gambar) }}" 
                                     alt="Current Image" 
                                     style="max-height: 150px;" 
                                     class="rounded-3 shadow-sm">
                                @else
                                <img id="gambarPreview" src="#" alt="Preview" style="max-height: 150px; display: none;" class="rounded-3 shadow-sm">
                                @endif
                            </div>
                            <small class="text-muted">Format: JPG, PNG, JPEG. Kosongkan jika tidak ingin mengubah gambar.</small>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <!-- Status -->
                        <div class="card border-0 bg-light mb-4">
                            <div class="card-body">
                                <h6 class="fw-bold mb-3" style="color: #6B0F4B;">Status Program</h6>
                                
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="status" name="status" value="1" {{ old('status', $program->status) ? 'checked' : '' }}>
                                        <label class="form-check-label fw-semibold" for="status">
                                            Aktif
                                        </label>
                                    </div>
                                    <small class="text-muted">Nonaktifkan jika program belum dimulai atau sudah selesai</small>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="card border-0 bg-light">
                            <div class="card-body">
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary btn-lg rounded-pill">
                                        <i class="bi bi-save me-2"></i> Update Program
                                    </button>
                                    <a href="{{ route('admin.program.index') }}" class="btn btn-outline-secondary rounded-pill">
                                        <i class="bi bi-x-circle me-2"></i> Batal
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
function previewImage(input) {
    const preview = document.getElementById('gambarPreview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush

<style>
.form-control:focus, .form-select:focus {
    border-color: #D4145A;
    box-shadow: 0 0 0 0.2rem rgba(212,20,90,0.25);
}

.form-check-input:checked {
    background-color: #D4145A;
    border-color: #D4145A;
}

.btn-primary {
    background-color: #D4145A;
    border-color: #D4145A;
}

.btn-primary:hover {
    background-color: #6B0F4B;
    border-color: #6B0F4B;
}
</style>
@endsection