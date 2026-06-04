@extends('layouts.app')

@section('title', 'Data Masyarakat')

@section('content')
<div class="container-fluid px-4 py-4">
    <!-- Page Header -->
    <div class="row mb-4 align-items-end">
        <div class="col-md-6">
            <h2 class="fw-bold mb-1" style="color: #1a237e;">
                <i class="bi bi-people-fill me-2" style="color: #3949ab;"></i>Data Masyarakat
            </h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item active">Masyarakat</li>
                </ol>
            </nav>
        </div>
        <div class="col-md-6 text-md-end mt-3 mt-md-0">
            <a href="{{ route('admin.masyarakat.create') }}" class="btn btn-primary rounded-3 px-4 shadow-sm border-0" style="background: #1a237e;">
                <i class="bi bi-person-plus-fill me-2"></i>Tambah Data Baru
            </a>
        </div>
    </div>

    <!-- Filter Card -->
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">
            <form method="GET" action="{{ route('admin.masyarakat.index') }}" class="row g-3">
                <div class="col-lg-4 col-md-6">
                    <label class="form-label fw-bold small text-muted">Cari Masyarakat</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-0"><i class="bi bi-search"></i></span>
                        <input type="text" class="form-control bg-light border-0 shadow-none" name="search" 
                               value="{{ request('search') }}" placeholder="NIK atau Nama Lengkap...">
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <label class="form-label fw-bold small text-muted">Desa/Kelurahan</label>
                    <select class="form-select bg-light border-0 shadow-none" name="desa">
                        <option value="">Semua Wilayah</option>
                        @foreach($desaList as $desa)
                            <option value="{{ $desa }}" {{ request('desa') == $desa ? 'selected' : '' }}>{{ $desa }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-2 col-md-6">
                    <label class="form-label fw-bold small text-muted">Gender</label>
                    <select class="form-select bg-light border-0 shadow-none" name="jenis_kelamin">
                        <option value="">Semua</option>
                        <option value="Laki-laki" {{ request('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ request('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-6 d-flex align-items-end gap-2">
                    <button type="submit" class="btn btn-dark w-100 rounded-3">Filter</button>
                    <a href="{{ route('admin.masyarakat.index') }}" class="btn btn-outline-secondary w-100 rounded-3">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Data Table Card -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-header bg-white py-3 px-4 border-bottom d-flex justify-content-between align-items-center">
            <span class="text-muted small fw-bold text-uppercase">Daftar Masyarakat</span>
            <div class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-2">
                Total: {{ $data->total() }} Jiwa
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3 text-muted small fw-bold">NO</th>
                            <th class="py-3 text-muted small fw-bold">IDENTITAS</th>
                            <th class="py-3 text-muted small fw-bold">KELAHIRAN</th>
                            <th class="py-3 text-muted small fw-bold text-center">GENDER</th>
                            <th class="py-3 text-muted small fw-bold">WILAYAH</th>
                            <th class="py-3 text-muted small fw-bold text-center">STATUS</th>
                            <th class="py-3 text-muted small fw-bold text-end pe-4">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $item)
                        <tr>
                            <td class="ps-4 text-muted small">{{ $loop->iteration + ($data->currentPage() - 1) * $data->perPage() }}</td>
                            <td>
                                <div class="fw-bold text-dark">{{ $item->nama_lengkap }}</div>
                                <div class="text-muted" style="font-size: 0.75rem; font-family: 'Courier New', Courier, monospace;">
                                    <i class="bi bi-card-list me-1"></i>{{ $item->nik }}
                                </div>
                            </td>
                            <td>
                                <div class="small">{{ $item->tempat_lahir }}</div>
                                <div class="text-muted small">{{ \Carbon\Carbon::parse($item->tanggal_lahir)->translatedFormat('d M Y') }}</div>
                            </td>
                            <td class="text-center">
                                @if($item->jenis_kelamin == 'Laki-laki')
                                    <span class="text-primary small fw-semibold"><i class="bi bi-gender-male me-1"></i>L</span>
                                @else
                                    <span class="text-danger small fw-semibold"><i class="bi bi-gender-female me-1"></i>P</span>
                                @endif
                            </td>
                            <td>
                                <span class="small text-dark fw-medium"><i class="bi bi-geo-alt me-1 text-muted"></i>{{ $item->desa_kelurahan }}</span>
                            </td>
                            <td class="text-center">
                                @if($item->is_archived)
                                    <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill px-3 py-2">Arsip</span>
                                @else
                                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-2">Aktif</span>
                                @endif
                            </td>
                            <td class="text-end pe-4">
                                <div class="btn-group shadow-sm border rounded-3 overflow-hidden">
                                    <a href="{{ route('admin.masyarakat.show', $item->id) }}" class="btn btn-white btn-sm px-2 border-end" data-bs-toggle="tooltip" title="Detail">
                                        <i class="bi bi-eye text-primary"></i>
                                    </a>
                                    <a href="{{ route('admin.masyarakat.edit', $item->id) }}" class="btn btn-white btn-sm px-2 border-end" data-bs-toggle="tooltip" title="Edit">
                                        <i class="bi bi-pencil-square text-warning"></i>
                                    </a>
                                    @if(!$item->is_archived)
                                    <button type="button" class="btn btn-white btn-sm px-2 border-end text-secondary btn-archive" 
                                            data-id="{{ $item->id }}" data-bs-toggle="tooltip" title="Arsipkan">
                                        <i class="bi bi-archive"></i>
                                    </button>
                                    @endif
                                    <button type="button" class="btn btn-white btn-sm px-2 text-danger btn-delete" 
                                            data-id="{{ $item->id }}" data-bs-toggle="tooltip" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>

                                <!-- Hidden Forms -->
                                <form id="archive-form-{{ $item->id }}" action="{{ route('admin.masyarakat.archive-move', $item->id) }}" method="POST" class="d-none">
                                    @csrf @method('PATCH')
                                </form>
                                <form id="delete-form-{{ $item->id }}" action="{{ route('admin.masyarakat.destroy', $item->id) }}" method="POST" class="d-none">
                                    @csrf @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div class="py-4">
                                    <i class="bi bi-inbox fs-1 text-muted opacity-25"></i>
                                    <p class="text-muted mt-2">Data masyarakat tidak ditemukan.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="p-4 border-top d-flex justify-content-between align-items-center flex-wrap gap-3 bg-light-alt">
                <div class="text-muted small">
                    Menampilkan {{ $data->firstItem() ?? 0 }} - {{ $data->lastItem() ?? 0 }} dari {{ $data->total() }} data
                </div>
                <div class="pagination-modern">
                    {{ $data->appends(request()->query())->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* UI Enhancements */
    .bg-light-alt { background-color: #fcfcfc; }
    .btn-white { background: #fff; border: none; transition: 0.2s; }
    .btn-white:hover { background: #f8f9fa; }
    
    .table thead th {
        background-color: #f8f9fa;
        text-transform: uppercase;
        font-size: 0.7rem;
        letter-spacing: 0.05rem;
    }

    /* Subtle Badge Colors */
    .bg-success-subtle { background-color: rgba(25, 135, 84, 0.1) !important; }
    .bg-warning-subtle { background-color: rgba(255, 193, 7, 0.1) !important; }
    .bg-primary-subtle { background-color: rgba(26, 35, 126, 0.1) !important; }

    /* Custom Pagination Style */
    .pagination-modern .page-link {
        border: none;
        margin: 0 3px;
        border-radius: 8px !important;
        color: #1a237e;
        padding: 8px 16px;
    }
    .pagination-modern .page-item.active .page-link {
        background-color: #1a237e;
        color: white;
    }
</style>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // 1. Tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        tooltipTriggerList.map(function (el) { return new bootstrap.Tooltip(el) });

        // 2. Archive Handler
        document.querySelectorAll('.btn-archive').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                Swal.fire({
                    title: 'Arsipkan Data?',
                    text: "Data ini akan dipindahkan ke kategori arsip.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Arsipkan!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('archive-form-' + id).submit();
                    }
                });
            });
        });

        // 3. Delete Handler
        document.querySelectorAll('.btn-delete').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                Swal.fire({
                    title: 'Hapus Permanen?',
                    text: "Data yang dihapus tidak bisa dikembalikan!",
                    icon: 'error',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + id).submit();
                    }
                });
            });
        });
    });
</script>
@endsection