@extends('layouts.appi')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="laporan-card bg-white rounded-4 shadow-lg overflow-hidden">
                <div class="laporan-header bg-primary p-4 text-white text-center">
                    <i class="bi bi-megaphone-fill fs-1 mb-3"></i>
                    <h3 class="mb-2">Form Laporan Masyarakat</h3>
                    <p class="mb-0 opacity-75">Sampaikan laporan Anda dengan jujur dan bertanggung jawab</p>
                </div>
                
                <div class="p-4 p-md-5">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            <strong>Terjadi kesalahan!</strong>
                            <ul class="mb-0 mt-2">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" name="nama_pelapor" class="form-control @error('nama_pelapor') is-invalid @enderror" value="{{ old('nama_pelapor') }}" required>
                                @error('nama_pelapor')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">No. Telepon</label>
                                <input type="text" name="no_telepon" class="form-control @error('no_telepon') is-invalid @enderror" value="{{ old('no_telepon') }}">
                                @error('no_telepon')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Jenis Laporan <span class="text-danger">*</span></label>
                                <select name="jenis_laporan" class="form-select @error('jenis_laporan') is-invalid @enderror" required>
                                    <option value="">Pilih Jenis Laporan</option>
                                    <option value="Kekerasan" {{ old('jenis_laporan') == 'Kekerasan' ? 'selected' : '' }}>Kekerasan</option>
                                    <option value="Pelecehan" {{ old('jenis_laporan') == 'Pelecehan' ? 'selected' : '' }}>Pelecehan</option>
                                    <option value="Diskriminasi" {{ old('jenis_laporan') == 'Diskriminasi' ? 'selected' : '' }}>Diskriminasi</option>
                                    <option value="Penelantaran" {{ old('jenis_laporan') == 'Penelantaran' ? 'selected' : '' }}>Penelantaran</option>
                                    <option value="Permintaan Bantuan" {{ old('jenis_laporan') == 'Permintaan Bantuan' ? 'selected' : '' }}>Permintaan Bantuan</option>
                                    <option value="Konsultasi" {{ old('jenis_laporan') == 'Konsultasi' ? 'selected' : '' }}>Konsultasi</option>
                                    <option value="Lainnya" {{ old('jenis_laporan') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                                @error('jenis_laporan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Judul Laporan <span class="text-danger">*</span></label>
                            <input type="text" name="judul_laporan" class="form-control @error('judul_laporan') is-invalid @enderror" value="{{ old('judul_laporan') }}" required>
                            @error('judul_laporan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Isi Laporan <span class="text-danger">*</span></label>
                            <textarea name="isi_laporan" class="form-control @error('isi_laporan') is-invalid @enderror" rows="6" required>{{ old('isi_laporan') }}</textarea>
                            @error('isi_laporan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Lokasi Kejadian</label>
                                <input type="text" name="lokasi_kejadian" class="form-control @error('lokasi_kejadian') is-invalid @enderror" value="{{ old('lokasi_kejadian') }}">
                                @error('lokasi_kejadian')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Tanggal Kejadian</label>
                                <input type="date" name="tanggal_kejadian" class="form-control @error('tanggal_kejadian') is-invalid @enderror" value="{{ old('tanggal_kejadian') }}">
                                @error('tanggal_kejadian')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Foto Pendukung (Opsional)</label>
                            <input type="file" name="foto_pendukung" class="form-control @error('foto_pendukung') is-invalid @enderror" accept="image/*">
                            <small class="text-muted">Format: JPG, JPEG, PNG. Maksimal 2MB</small>
                            @error('foto_pendukung')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="alert alert-info mt-3">
                            <i class="bi bi-info-circle me-2"></i>
                            Laporan Anda akan diproses oleh tim kami. Kode laporan akan diberikan untuk melacak status laporan.
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">
                            <i class="bi bi-send me-2"></i>Kirim Laporan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/laporan.css') }}">
@endpush
@endsection