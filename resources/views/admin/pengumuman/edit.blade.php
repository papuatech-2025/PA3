{{-- resources/views/admin/pengumuman/edit.blade.php --}}
@extends('layouts.app')

@section('title', 'Edit Pengumuman')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-pencil-square"></i> Edit Pengumuman</h2>
        <a href="{{ route('admin.pengumuman.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.pengumuman.update', $pengumuman->id_pengumuman) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-8">
                        {{-- Judul --}}
                        <div class="mb-3">
                            <label for="judul" class="form-label fw-semibold">Judul Pengumuman <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('judul') is-invalid @enderror" 
                                   id="judul" 
                                   name="judul" 
                                   value="{{ old('judul', $pengumuman->judul) }}"
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
                                      rows="8">{{ old('isi', $pengumuman->isi) }}</textarea>
                            <div class="form-text">Gunakan paragraf yang jelas dan informatif.</div>
                            @error('isi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        {{-- ID Admin --}}
                        <div class="mb-3">
                            <label for="id_admin" class="form-label fw-semibold">ID Admin <span class="text-danger">*</span></label>
                            <select class="form-select @error('id_admin') is-invalid @enderror" id="id_admin" name="id_admin">
                                <option value="">-- Pilih Admin --</option>
                                <option value="1" {{ old('id_admin', $pengumuman->id_admin) == 1 ? 'selected' : '' }}>Admin Utama (ID: 1)</option>
                                <option value="2" {{ old('id_admin', $pengumuman->id_admin) == 2 ? 'selected' : '' }}>Admin Konten (ID: 2)</option>
                                <option value="3" {{ old('id_admin', $pengumuman->id_admin) == 3 ? 'selected' : '' }}>Super Admin (ID: 3)</option>
                            </select>
                            @error('id_admin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @else
                                <div class="form-text">Pilih admin yang bertanggung jawab.</div>
                            @enderror
                        </div>

                        {{-- Info Tanggal --}}
                        <div class="alert alert-info">
                            <i class="bi bi-calendar"></i> <strong>Tanggal Dibuat</strong><br>
                            {{ $pengumuman->tanggal->format('d/m/Y H:i:s') }}
                        </div>

                        {{-- ID Pengumuman --}}
                        <div class="alert alert-secondary">
                            <i class="bi bi-hash"></i> <strong>ID Pengumuman</strong><br>
                            {{ $pengumuman->id_pengumuman }}
                        </div>

                        {{-- Info Update --}}
                        <div class="alert alert-warning">
                            <i class="bi bi-clock-history"></i> <strong>Terakhir Diupdate</strong><br>
                            {{ $pengumuman->updated_at ? $pengumuman->updated_at->format('d/m/Y H:i:s') : 'Belum pernah diupdate' }}
                        </div>
                    </div>
                </div>

                <hr>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.pengumuman.index') }}" class="btn btn-outline-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Update Pengumuman
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection