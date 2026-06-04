{{-- resources/views/admin/pengumuman/show.blade.php --}}
@extends('layouts.app')

@section('title', 'Detail Pengumuman')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-file-text"></i> Detail Pengumuman</h2>
        <div>
            <a href="{{ route('admin.pengumuman.edit', $pengumuman->id_pengumuman) }}" class="btn btn-primary">
                <i class="bi bi-pencil"></i> Edit
            </a>
            <a href="{{ route('admin.pengumuman.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-white py-3">
            <h3 class="card-title mb-0">{{ $pengumuman->judul }}</h3>
        </div>
        <div class="card-body">
            <div class="mb-3 pb-2 border-bottom">
                <div class="row">
                    <div class="col-md-6">
                        <small class="text-muted">
                            <i class="bi bi-calendar3"></i> Tanggal: 
                            {{ $pengumuman->tanggal->format('d/m/Y H:i:s') }}
                        </small>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <small class="text-muted">
                            <i class="bi bi-person-badge"></i> ID Admin: {{ $pengumuman->id_admin }}
                        </small>
                    </div>
                </div>
            </div>
            
            <div class="pengumuman-content mt-3" style="line-height: 1.8; font-size: 1rem;">
                {!! nl2br(e($pengumuman->isi)) !!}
            </div>
        </div>
        <div class="card-footer bg-white">
            <div class="d-flex justify-content-between">
                <small class="text-muted">
                    <i class="bi bi-clock"></i> ID Pengumuman: {{ $pengumuman->id_pengumuman }}
                </small>
                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                    <i class="bi bi-trash"></i> Hapus
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="bi bi-exclamation-triangle"></i> Konfirmasi Hapus
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus pengumuman:</p>
                <p class="fw-bold text-danger">"{{ $pengumuman->judul }}"</p>
                <p class="text-muted small">Data yang dihapus tidak dapat dikembalikan!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form action="{{ route('admin.pengumuman.destroy', $pengumuman->id_pengumuman) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash"></i> Ya, Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection