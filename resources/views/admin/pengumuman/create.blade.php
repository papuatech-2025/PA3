{{-- resources/views/admin/pengumuman/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Tambah Pengumuman')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-plus-circle"></i> Tambah Pengumuman</h2>
        <a href="{{ route('admin.pengumuman.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.pengumuman.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-8">
                        {{-- Judul --}}
                        <div class="mb-3">
                            <label for="judul" class="form-label fw-semibold">Judul Pengumuman <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('judul') is-invalid @enderror" 
                                   id="judul" 
                                   name="judul" 
                                   value="{{ old('judul') }}"
                                   placeholder="Masukkan judul pengumuman" 
                                   autofocus>
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Isi --}}
                        <div class="mb-3">
                            <label for="isi" class="form-label fw-semibold">Isi Pengumuman <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('isi') is-invalid @enderror" 
                                      id="isi" 
                                      name="isi" 
                                      rows="8" 
                                      placeholder="Tulis detail pengumuman di sini...">{{ old('isi') }}</textarea>
                            <div class="form-text">Gunakan paragraf yang jelas dan informatif.</div>
                            @error('isi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        {{-- ✅ TAMBAHKAN FIELD ID ADMIN --}}
                        <div class="mb-3">
                            <label for="id_admin" class="form-label fw-semibold">ID Admin <span class="text-danger">*</span></label>
                            <select class="form-select @error('id_admin') is-invalid @enderror" 
                                    id="id_admin" 
                                    name="id_admin" 
                                    required>
                                <option value="">-- Pilih Admin --</option>
                                <option value="1" {{ old('id_admin') == 1 ? 'selected' : '' }}>Admin Utama (ID: 1)</option>
                                <option value="2" {{ old('id_admin') == 2 ? 'selected' : '' }}>Admin Konten (ID: 2)</option>
                                <option value="3" {{ old('id_admin') == 3 ? 'selected' : '' }}>Super Admin (ID: 3)</option>
                            </select>
                            @error('id_admin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @else
                                <div class="form-text">Pilih admin yang bertanggung jawab atas pengumuman ini.</div>
                            @enderror
                        </div>

                        {{-- Info Tanggal --}}
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle"></i> <strong>Tanggal</strong><br>
                            Tanggal akan diisi otomatis oleh sistem saat pengumuman disimpan ({{ date('d/m/Y H:i:s') }}).
                        </div>

                        {{-- ID Pengumuman --}}
                        <div class="alert alert-secondary">
                            <i class="bi bi-hash"></i> <strong>ID Pengumuman</strong><br>
                            ID akan dibuat otomatis oleh sistem.
                        </div>
                    </div>
                </div>

                <hr>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.pengumuman.index') }}" class="btn btn-outline-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Simpan Pengumuman
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection