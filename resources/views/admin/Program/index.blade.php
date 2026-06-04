@extends('layouts.app')

@section('title', 'Data Program')

@section('content')
<div class="container-fluid px-4">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4 mt-4">
        <div>
            <h2 class="fw-bold mb-0" style="color: #6B0F4B;">
                <i class="bi bi-calendar-event-fill me-2" style="color: #D4145A;"></i>
                Data Program
            </h2>
            <p class="text-muted small mb-0">Kelola semua daftar program organisasi Anda di sini.</p>
        </div>
        <a href="{{ route('admin.program.create') }}" class="btn btn-primary rounded-3 px-4 shadow-sm">
            <i class="bi bi-plus-lg me-2"></i>Tambah Program
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
        <div class="d-flex align-items-center">
            <i class="bi bi-check-circle-fill me-2 fs-5"></i>
            <div>{{ session('success') }}</div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Table Card -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-muted">
                        <tr>
                            <th class="ps-4 py-3 text-uppercase small fw-bold">Gambar</th>
                            <th class="py-3 text-uppercase small fw-bold">Detail Program</th>
                            <th class="py-3 text-uppercase small fw-bold text-center">Kategori</th>
                            <th class="py-3 text-uppercase small fw-bold text-center">Status</th>
                            <th class="py-3 text-uppercase small fw-bold text-end pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($programs as $program)
                        <tr>
                            <td class="ps-4">
                                @if($program->gambar)
                                <img src="{{ asset('storage/' . $program->gambar) }}" 
                                     alt="{{ $program->nama_program }}" 
                                     class="rounded-3 shadow-sm"
                                     style="width: 60px; height: 60px; object-fit: cover; border: 1px solid #eee;">
                                @else
                                <div class="bg-light rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px;">
                                    <i class="bi bi-image text-muted fs-4"></i>
                                </div>
                                @endif
                            </td>
                            <td>
                                <div class="fw-bold text-dark mb-0">{{ $program->nama_program }}</div>
                                <div class="text-muted small d-flex align-items-center mt-1">
                                    <i class="bi bi-geo-alt me-1"></i> {{ $program->lokasi ?: 'Lokasi belum diatur' }}
                                    <span class="mx-2 text-silver">|</span>
                                    <i class="bi bi-calendar3 me-1"></i> 
                                    {{ $program->tanggal_mulai ? \Carbon\Carbon::parse($program->tanggal_mulai)->format('d M Y') : '-' }}
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="badge rounded-pill px-3 py-2" style="background: rgba(212, 20, 90, 0.1); color: #D4145A; border: 1px solid rgba(212, 20, 90, 0.2);">
                                    {{ $program->kategori }}
                                </span>
                            </td>
                            <td class="text-center">
                                @if($program->status)
                                    <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 rounded-pill">
                                        <i class="bi bi-dot"></i> Aktif
                                    </span>
                                @else
                                    <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle px-3 py-2 rounded-pill">
                                        <i class="bi bi-dot"></i> Tidak Aktif
                                    </span>
                                @endif
                            </td>
                            <td class="text-end pe-4">
                                <div class="btn-group shadow-sm border rounded-3 overflow-hidden" role="group">
                                    <a href="{{ route('admin.program.show', $program->id) }}" 
                                       class="btn btn-white btn-sm px-3 border-end" 
                                       data-bs-toggle="tooltip" 
                                       title="Lihat Detail">
                                        <i class="bi bi-eye text-info"></i>
                                    </a>
                                    <a href="{{ route('admin.program.edit', $program->id) }}" 
                                       class="btn btn-white btn-sm px-3 border-end" 
                                       data-bs-toggle="tooltip" 
                                       title="Edit Data">
                                        <i class="bi bi-pencil-square text-warning"></i>
                                    </a>
                                    <button type="button" 
                                            class="btn btn-white btn-sm px-3" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#deleteModal{{ $program->id }}"
                                            title="Hapus Program">
                                        <i class="bi bi-trash text-danger"></i>
                                    </button>
                                </div>

                                <!-- Modal Konfirmasi Hapus (Lebih Profesional dibanding confirm browser) -->
                                <div class="modal fade" id="deleteModal{{ $program->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-sm">
                                        <div class="modal-content border-0 shadow">
                                            <div class="modal-body p-4 text-center">
                                                <i class="bi bi-exclamation-circle text-danger display-4 mb-3 d-block"></i>
                                                <h5 class="fw-bold">Hapus Program?</h5>
                                                <p class="text-muted small">Data yang dihapus tidak dapat dikembalikan lagi.</p>
                                                <div class="d-flex justify-content-center gap-2 mt-4">
                                                    <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Batal</button>
                                                    <form action="{{ route('admin.program.destroy', $program->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger px-4">Ya, Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <div class="py-4">
                                    <i class="bi bi-inbox fs-1 d-block mb-3 opacity-25"></i>
                                    <p>Belum ada data program yang tersedia.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination Section -->
    <div class="d-flex justify-content-between align-items-center mt-4 mb-5">
        <div class="text-muted small">
            Menampilkan {{ $programs->firstItem() }} sampai {{ $programs->lastItem() }} dari {{ $programs->total() }} data
        </div>
        <div>
            {{ $programs->links() }}
        </div>
    </div>
</div>

<style>
    /* Styling untuk tombol di dalam Table */
    .btn-white {
        background: #ffffff;
        color: #333;
        border: none;
        transition: all 0.2s;
    }
    .btn-white:hover {
        background: #f8f9fa;
        color: #000;
    }
    .table thead th {
        letter-spacing: 0.5px;
    }
    .text-silver {
        color: #cbd5e0;
    }
    /* Badge styling */
    .bg-success-subtle { background-color: rgba(25, 135, 84, 0.1) !important; }
    .bg-secondary-subtle { background-color: rgba(108, 117, 125, 0.1) !important; }
    /* Pagination Customization */
    .pagination { margin-bottom: 0; }
    .page-link { border-radius: 8px !important; margin: 0 3px; border: none; color: #6B0F4B; }
    .page-item.active .page-link { background-color: #6B0F4B; }
</style>

<script>
    // Inisialisasi tooltips Bootstrap
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>
@endsection