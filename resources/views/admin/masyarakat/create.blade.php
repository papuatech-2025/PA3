@extends('layouts.app')

@section('title', (isset($data) ? 'Edit' : 'Tambah') . ' Data Masyarakat')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Header -->
            <div class="d-flex align-items-center mb-4">
                <a href="{{ route('admin.masyarakat.index') }}" class="btn btn-light rounded-circle me-3">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <div>
                    <h2 class="fw-bold mb-0" style="color: #1a237e;">{{ isset($data) ? 'Perbarui' : 'Daftarkan' }} Masyarakat</h2>
                    <p class="text-muted mb-0">Pastikan informasi NIK dan Alamat sesuai dengan KTP.</p>
                </div>
            </div>

            <form action="{{ isset($data) ? route('admin.masyarakat.update', $data->id) : route('admin.masyarakat.store') }}" method="POST">
                @csrf
                @if(isset($data)) @method('PUT') @endif

                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body p-4 p-md-5">
                        <!-- Section 1: Identitas -->
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <h5 class="fw-bold"><i class="bi bi-person-badge me-2 text-primary"></i>Identitas Pribadi</h5>
                                <p class="text-muted small">Data dasar sesuai dengan kartu identitas masyarakat.</p>
                            </div>
                            <div class="col-md-8">
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label class="form-label fw-bold small">NIK (Nomor Induk Kependudukan) <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control bg-light border-0 py-2 @error('nik') is-invalid @enderror" name="nik" value="{{ old('nik', $data->nik ?? '') }}" maxlength="16" placeholder="Masukkan 16 digit NIK">
                                        @error('nik')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label fw-bold small">Nama Lengkap <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control bg-light border-0 py-2 @error('nama_lengkap') is-invalid @enderror" name="nama_lengkap" value="{{ old('nama_lengkap', $data->nama_lengkap ?? '') }}" placeholder="Nama sesuai KTP">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold small">Tempat Lahir</label>
                                        <input type="text" class="form-control bg-light border-0 py-2" name="tempat_lahir" value="{{ old('tempat_lahir', $data->tempat_lahir ?? '') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold small">Tanggal Lahir</label>
                                        <input type="date" class="form-control bg-light border-0 py-2" name="tanggal_lahir" value="{{ old('tanggal_lahir', $data->tanggal_lahir ?? '') }}">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label fw-bold small">Jenis Kelamin</label>
                                        <div class="d-flex gap-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="jenis_kelamin" value="Laki-laki" id="l" {{ old('jenis_kelamin', $data->jenis_kelamin ?? '') == 'Laki-laki' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="l">Laki-laki</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="jenis_kelamin" value="Perempuan" id="p" {{ old('jenis_kelamin', $data->jenis_kelamin ?? '') == 'Perempuan' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="p">Perempuan</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-5 opacity-25">

                        <!-- Section 2: Domisili -->
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <h5 class="fw-bold"><i class="bi bi-geo-alt-fill me-2 text-danger"></i>Domisili & Kontak</h5>
                                <p class="text-muted small">Informasi tempat tinggal dan nomor yang bisa dihubungi.</p>
                            </div>
                            <div class="col-md-8">
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label class="form-label fw-bold small">Alamat Lengkap</label>
                                        <textarea class="form-control bg-light border-0" name="alamat" rows="3">{{ old('alamat', $data->alamat ?? '') }}</textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold small">Desa/Kelurahan</label>
                                        <input type="text" class="form-control bg-light border-0 py-2" name="desa_kelurahan" value="{{ old('desa_kelurahan', $data->desa_kelurahan ?? '') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold small">No. Telepon</label>
                                        <input type="text" class="form-control bg-light border-0 py-2" name="no_telepon" value="{{ old('no_telepon', $data->no_telepon ?? '') }}" placeholder="08xxxx">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-light p-4 text-end border-0">
                        <button type="submit" class="btn btn-primary px-5 py-2 fw-bold rounded-3 shadow">
                            <i class="bi bi-check-circle-fill me-2"></i>{{ isset($data) ? 'Simpan Perubahan' : 'Daftarkan Masyarakat' }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection