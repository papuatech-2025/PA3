@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            
            {{-- Header --}}
            <div class="d-flex align-items-center mb-4">
                <a href="{{ route('admin.layanan.index') }}" class="btn btn-light rounded-circle me-3 shadow-sm">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <div>
                    <h2 class="fw-bold mb-0" style="color: #1a237e;">
                        {{ isset($layanan) ? 'Edit' : 'Tambah' }} Layanan
                    </h2>
                    <p class="text-muted mb-0">Silakan lengkapi informasi layanan di bawah ini.</p>
                </div>
            </div>

            <form action="{{ isset($layanan) ? route('admin.layanan.update', $layanan->id_layanan) : route('admin.layanan.store') }}" 
                  method="POST" 
                  enctype="multipart/form-data">
                @csrf
                @if(isset($layanan)) @method('PUT') @endif

                <div class="row g-4">
                    {{-- Kolom Kiri: Form Utama --}}
                    <div class="col-lg-8">
                        <div class="card border-0 shadow-sm rounded-4 mb-4">
                            <div class="card-body p-4 p-md-5">
                                <h5 class="fw-bold mb-4" style="color: #1a237e;">
                                    <i class="bi bi-info-circle me-2"></i>Informasi Layanan
                                </h5>

                                <div class="mb-4">
                                    <label for="nama_layanan" class="form-label fw-bold small text-muted">NAMA LAYANAN <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control bg-light border-0 py-2 @error('nama_layanan') is-invalid @enderror" 
                                           id="nama_layanan" name="nama_layanan" 
                                           value="{{ old('nama_layanan', $layanan->nama_layanan ?? '') }}" 
                                           placeholder="Contoh: Pengaduan Masyarakat" required>
                                    @error('nama_layanan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="deskripsi" class="form-label fw-bold small text-muted">DESKRIPSI LENGKAP <span class="text-danger">*</span></label>
                                    <textarea class="form-control bg-light border-0 @error('deskripsi') is-invalid @enderror" 
                                              id="deskripsi" name="deskripsi" rows="6" 
                                              placeholder="Tuliskan detail layanan secara lengkap..." required>{{ old('deskripsi', $layanan->deskripsi ?? '') }}</textarea>
                                    @error('deskripsi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-8">
                                        <label for="icon" class="form-label fw-bold small text-muted">ICON (BOOTSTRAP ICONS)</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-0"><i class="bi bi-search"></i></span>
                                            <input type="text" class="form-control bg-light border-0 py-2 @error('icon') is-invalid @enderror" 
                                                   id="icon-input" name="icon" 
                                                   value="{{ old('icon', $layanan->icon ?? '') }}" 
                                                   placeholder="Contoh: bi-star-fill">
                                        </div>
                                        <small class="text-muted mt-2 d-block">Gunakan nama class dari <a href="https://icons.getbootstrap.com/" target="_blank">Bootstrap Icons</a></small>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-bold small text-muted">PREVIEW ICON</label>
                                        <div class="bg-light rounded-3 d-flex align-items-center justify-content-center" style="height: 42px;">
                                            <i id="icon-preview" class="{{ old('icon', $layanan->icon ?? 'bi-question-circle') }} fs-4 text-primary"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Kolom Kanan: Media & Status --}}
                    <div class="col-lg-4">
                        {{-- Status Visibility --}}
                        <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden">
                            <div class="card-header bg-white py-3 px-4 border-bottom">
                                <h6 class="fw-bold mb-0">Status Visibilitas</h6>
                            </div>
                            <div class="card-body p-4">
                                <div class="form-check form-switch d-flex align-items-center justify-content-between p-0">
                                    <label class="form-check-label fw-bold text-muted" for="is_active">Aktifkan Layanan</label>
                                    <input class="form-check-input ms-0" type="checkbox" role="switch" 
                                           id="is_active" name="is_active" style="width: 3rem; height: 1.5rem; cursor: pointer;"
                                           {{ old('is_active', $layanan->is_active ?? true) ? 'checked' : '' }}>
                                </div>
                                <p class="small text-muted mt-3 mb-0">
                                    Jika dinonaktifkan, layanan tidak akan muncul di halaman publik.
                                </p>
                            </div>
                        </div>

                        {{-- Upload Gambar --}}
                        <div class="card border-0 shadow-sm rounded-4 mb-4">
                            <div class="card-header bg-white py-3 px-4 border-bottom">
                                <h6 class="fw-bold mb-0">Gambar Thumbnail</h6>
                            </div>
                            <div class="card-body p-4 text-center">
                                @if(isset($layanan) && $layanan->gambar)
                                    <div class="mb-3">
                                        <img src="{{ asset($layanan->gambar) }}" 
                                             class="img-fluid rounded-3 shadow-sm border" 
                                             id="preview-img" style="max-height: 200px; object-fit: cover;">
                                        <p class="small text-muted mt-2">Gambar saat ini</p>
                                    </div>
                                @else
                                    <div class="mb-3">
                                        <img src="https://placehold.co/600x400/f8f9fa/adb5bd?text=Preview+Gambar" 
                                             class="img-fluid rounded-3 shadow-sm border" id="preview-img">
                                    </div>
                                @endif
                                
                                <input type="file" class="form-control bg-light border-0 @error('gambar') is-invalid @enderror" 
                                       id="gambar" name="gambar" accept="image/*" onchange="previewImage(this)">
                                @error('gambar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="card border-0 shadow-sm rounded-4 p-2 bg-light">
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary w-100 py-3 rounded-3 fw-bold shadow-sm border-0 mb-2" style="background: #1a237e;">
                                    <i class="bi bi-save-fill me-2"></i> {{ isset($layanan) ? 'Update' : 'Simpan' }} Layanan
                                </button>
                                <a href="{{ route('admin.layanan.index') }}" class="btn btn-white w-100 py-2 text-muted">
                                    Batalkan
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    /* Styling Form */
    .form-control:focus, .form-select:focus {
        background-color: #fff !important;
        box-shadow: 0 0 0 0.25rem rgba(26, 35, 126, 0.1) !important;
        border: 1px solid #1a237e !important;
    }
    .input-group-text {
        border: none;
    }
    .btn-white {
        background: transparent;
        border: none;
    }
    .btn-white:hover {
        background: #eee;
    }
    /* Switch Adjustment */
    .form-check-input:checked {
        background-color: #198754;
        border-color: #198754;
    }
</style>

<script>
    // Preview Icon saat diketik
    document.getElementById('icon-input').addEventListener('input', function() {
        const preview = document.getElementById('icon-preview');
        preview.className = this.value + ' fs-4 text-primary';
    });

    // Preview Gambar saat dipilih
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview-img').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection