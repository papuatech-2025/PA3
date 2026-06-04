@extends('layouts.app')

@section('title', 'Detail Program: ' . $program->nama_program)

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="mt-4" style="color: #6B0F4B;">
                <i class="bi bi-eye me-2" style="color: #D4145A;"></i>
                Detail Program
            </h1>
            <ol class="breadcrumb mb-0 bg-transparent p-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="color: #D4145A;">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.program.index') }}" style="color: #D4145A;">Program</a></li>
                <li class="breadcrumb-item active">{{ $program->nama_program }}</li>
            </ol>
        </div>
        <div>
            <a href="{{ route('admin.program.edit', $program) }}" class="btn btn-warning rounded-pill px-4 me-2">
                <i class="bi bi-pencil me-1"></i> Edit
            </a>
            <a href="{{ route('admin.program.index') }}" class="btn btn-secondary rounded-pill px-4">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <!-- Gambar Utama -->
                    @if($program->gambar)
                    <div class="mb-4 text-center">
                        <img src="{{ asset('storage/' . $program->gambar) }}" 
                             alt="{{ $program->nama_program }}" 
                             class="img-fluid rounded-3 shadow-sm"
                             style="max-height: 400px; width: auto;">
                    </div>
                    @endif

                    <!-- Nama Program -->
                    <h2 class="fw-bold" style="color: #6B0F4B;">{{ $program->nama_program }}</h2>
                    
                    <!-- Status Badge -->
                    <div class="mb-3">
                        @if($program->status)
                        <span class="badge bg-success me-2">Aktif</span>
                        @else
                        <span class="badge bg-secondary me-2">Tidak Aktif</span>
                        @endif
                    </div>

                    <!-- Informasi Dasar -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="info-item mb-3">
                                <label class="fw-bold text-muted">Kategori</label>
                                <p class="mb-0">
                                    <span class="badge" style="background: #D4145A; color: white;">
                                        {{ $program->kategori }}
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item mb-3">
                                <label class="fw-bold text-muted">Lokasi</label>
                                <p class="mb-0">
                                    <i class="bi bi-geo-alt me-1 text-primary"></i>
                                    {{ $program->lokasi ?: 'Tidak ditentukan' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="info-item mb-3">
                                <label class="fw-bold text-muted">Tanggal Pelaksanaan</label>
                                <p class="mb-0">
                                    <i class="bi bi-calendar me-1 text-primary"></i>
                                    @if($program->tanggal_mulai)
                                        {{ \Carbon\Carbon::parse($program->tanggal_mulai)->format('d F Y') }}
                                        @if($program->tanggal_selesai)
                                            - {{ \Carbon\Carbon::parse($program->tanggal_selesai)->format('d F Y') }}
                                        @endif
                                    @else
                                        Tidak ditentukan
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item mb-3">
                                <label class="fw-bold text-muted">Slug URL</label>
                                <p class="mb-0">
                                    <i class="bi bi-link me-1 text-primary"></i>
                                    <code>{{ $program->slug }}</code>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-4">
                        <label class="fw-bold text-muted">Deskripsi Program</label>
                        <div class="bg-light p-3 rounded-3 mt-2">
                            {!! nl2br(e($program->deskripsi)) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Info Waktu -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i> Informasi Lainnya</h5>
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <i class="bi bi-calendar-plus me-2 text-primary"></i>
                        <strong>Dibuat:</strong><br>
                        {{ \Carbon\Carbon::parse($program->created_at)->format('d F Y H:i') }}
                    </div>
                    <div class="mb-2">
                        <i class="bi bi-calendar-check me-2 text-primary"></i>
                        <strong>Terakhir Diupdate:</strong><br>
                        {{ \Carbon\Carbon::parse($program->updated_at)->format('d F Y H:i') }}
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.program.edit', $program) }}" class="btn btn-warning">
                            <i class="bi bi-pencil me-2"></i> Edit Program
                        </a>
                        <form action="{{ route('admin.program.destroy', $program) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus program ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="bi bi-trash me-2"></i> Hapus Program
                            </button>
                        </form>
                        <a href="{{ route('program.show', $program->slug) }}" class="btn btn-outline-primary" target="_blank">
                            <i class="bi bi-eye me-2"></i> Lihat di Halaman Public
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.info-item label {
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
.info-item p {
    font-size: 1rem;
}
</style>
@endsection