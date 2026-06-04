@extends('layouts.app')

@section('title', 'Laporan Masyarakat')

@section('content')
<div class="container-fluid px-4 py-4">
    <!-- Header Section -->
    <div class="row mb-4 align-items-center">
        <div class="col">
            <h2 class="fw-bold mb-1" style="color: #1a237e;">
                <i class="bi bi-file-earmark-text-fill me-2" style="color: #3949ab;"></i>Laporan Masyarakat
            </h2>
            <p class="text-muted small mb-0">Manajemen pengaduan dan aspirasi dari masyarakat.</p>
        </div>
    </div>

    <!-- Statistik Cards (Modern Style) -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted small fw-bold text-uppercase mb-2">Total Laporan</h6>
                            <h3 class="fw-bold mb-0">{{ number_format($statistik['total']) }}</h3>
                        </div>
                        <div class="rounded-circle bg-primary bg-opacity-10 p-3">
                            <i class="bi bi-inbox text-primary fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 h-100 border-start border-danger border-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted small fw-bold text-uppercase mb-2">Laporan Baru</h6>
                            <h3 class="fw-bold mb-0 text-danger">{{ number_format($statistik['baru']) }}</h3>
                        </div>
                        <div class="rounded-circle bg-danger bg-opacity-10 p-3">
                            <i class="bi bi-envelope-exclamation text-danger fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 h-100 border-start border-warning border-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted small fw-bold text-uppercase mb-2">Diproses</h6>
                            <h3 class="fw-bold mb-0 text-warning">{{ number_format($statistik['diproses']) }}</h3>
                        </div>
                        <div class="rounded-circle bg-warning bg-opacity-10 p-3">
                            <i class="bi bi-arrow-repeat text-warning fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 h-100 border-start border-success border-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted small fw-bold text-uppercase mb-2">Selesai</h6>
                            <h3 class="fw-bold mb-0 text-success">{{ number_format($statistik['selesai']) }}</h3>
                        </div>
                        <div class="rounded-circle bg-success bg-opacity-10 p-3">
                            <i class="bi bi-check2-circle text-success fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Card -->
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">
            <form method="GET" action="{{ route('admin.laporan.index') }}" class="row g-3">
                <div class="col-lg-4 col-md-6">
                    <label class="form-label fw-bold small text-muted">Cari Laporan</label>
                    <input type="text" name="search" class="form-control bg-light border-0 py-2" placeholder="Kode, Nama, atau Judul..." value="{{ request('search') }}">
                </div>
                <div class="col-lg-3 col-md-6">
                    <label class="form-label fw-bold small text-muted">Jenis Laporan</label>
                    <select name="jenis_laporan" class="form-select bg-light border-0 py-2">
                        <option value="">Semua Jenis</option>
                        @foreach(['Kekerasan', 'Pelecehan', 'Diskriminasi', 'Penelantaran', 'Permintaan Bantuan'] as $jenis)
                            <option value="{{ $jenis }}" {{ request('jenis_laporan') == $jenis ? 'selected' : '' }}>{{ $jenis }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-3 col-md-6">
                    <label class="form-label fw-bold small text-muted">Status</label>
                    <select name="status" class="form-select bg-light border-0 py-2">
                        <option value="">Semua Status</option>
                        <option value="baru" {{ request('status') == 'baru' ? 'selected' : '' }}>Baru</option>
                        <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>
                <div class="col-lg-2 col-md-6 d-flex align-items-end">
                    <button type="submit" class="btn btn-dark w-100 rounded-3 py-2">Filter</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Table Card -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3 text-muted small fw-bold">ID & TANGGAL</th>
                            <th class="py-3 text-muted small fw-bold">PELAPOR</th>
                            <th class="py-3 text-muted small fw-bold">KATEGORI</th>
                            <th class="py-3 text-muted small fw-bold">JUDUL LAPORAN</th>
                            <th class="py-3 text-muted small fw-bold text-center">STATUS</th>
                            <th class="py-3 text-muted small fw-bold text-end pe-4">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($laporans as $laporan)
                        <tr>
                            <td class="ps-4">
                                <div class="fw-bold text-primary small">{{ $laporan->kode_laporan }}</div>
                                <div class="text-muted" style="font-size: 0.75rem;">{{ $laporan->created_at->format('d/m/Y H:i') }}</div>
                            </td>
                            <td>
                                <div class="fw-bold text-dark">{{ $laporan->nama_pelapor }}</div>
                                <div class="text-muted small">{{ $laporan->email }}</div>
                            </td>
                            <td>
                                <span class="badge bg-secondary-subtle text-secondary px-3 py-2 rounded-pill border border-secondary-subtle">
                                    {{ $laporan->jenis_laporan }}
                                </span>
                            </td>
                            <td>
                                <div class="text-dark small fw-medium text-truncate" style="max-width: 250px;">
                                    {{ $laporan->judul_laporan }}
                                </div>
                            </td>
                            <td class="text-center">
                                @php
                                    $statusClass = match($laporan->status) {
                                        'baru' => 'bg-danger-subtle text-danger border-danger-subtle',
                                        'diproses' => 'bg-warning-subtle text-warning border-warning-subtle',
                                        'selesai' => 'bg-success-subtle text-success border-success-subtle',
                                        default => 'bg-secondary-subtle text-secondary border-secondary-subtle',
                                    };
                                @endphp
                                <span class="badge {{ $statusClass }} px-3 py-2 rounded-pill border text-uppercase" style="font-size: 0.7rem;">
                                    {{ $laporan->status }}
                                </span>
                            </td>
                            <td class="text-end pe-4">
                                <div class="btn-group shadow-sm border rounded-3 overflow-hidden">
                                    <a href="{{ route('admin.laporan.show', $laporan->id) }}" class="btn btn-white btn-sm px-3 border-end" title="Lihat Detail">
                                        <i class="bi bi-eye text-primary"></i>
                                    </a>
                                    <button type="button" class="btn btn-white btn-sm px-3 text-danger btn-delete" data-id="{{ $laporan->id }}" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                                <form id="delete-form-{{ $laporan->id }}" action="{{ route('admin.laporan.destroy', $laporan->id) }}" method="POST" class="d-none">
                                    @csrf @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <i class="bi bi-inbox fs-1 text-muted opacity-25"></i>
                                <p class="text-muted mt-2">Tidak ada laporan yang ditemukan.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-4 border-top">
                {{ $laporans->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>

<style>
    .bg-light { background-color: #f8f9fa !important; }
    .bg-primary-subtle { background-color: rgba(26, 35, 126, 0.1) !important; }
    .bg-danger-subtle { background-color: rgba(220, 53, 69, 0.1) !important; }
    .bg-warning-subtle { background-color: rgba(255, 193, 7, 0.1) !important; }
    .bg-success-subtle { background-color: rgba(25, 135, 84, 0.1) !important; }
    .bg-secondary-subtle { background-color: rgba(108, 117, 125, 0.1) !important; }
    .btn-white { background: #fff; border: none; transition: 0.2s; }
    .btn-white:hover { background: #f8f9fa; }
</style>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.querySelectorAll('.btn-delete').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            Swal.fire({
                title: 'Hapus Laporan?',
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        });
    });
</script>
@endsection