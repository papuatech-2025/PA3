@extends('layouts.app')

@section('title', 'Cari & Filter Data Masyarakat')

@section('content')

<style>
    .search-card {
        background: var(--white);
        border-radius: 16px;
        border: 1px solid var(--border);
        box-shadow: 0 2px 16px rgba(0,0,0,.05);
        overflow: hidden;
    }
    .card-header-custom {
        padding: 1rem 1.5rem;
        background: linear-gradient(135deg, var(--info) 0%, #0c5460 100%);
        border-bottom: none;
    }
    .card-header-custom h3 {
        color: var(--white);
        margin: 0;
        font-size: 1.1rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .filter-box {
        background: var(--surface);
        border-radius: 12px;
        padding: 1.25rem;
        margin-bottom: 1.5rem;
    }
    .result-info {
        background: #dcfce7;
        border-left: 4px solid var(--success);
        border-radius: 10px;
        padding: 0.85rem 1rem;
        margin-bottom: 1.25rem;
    }
    .table-custom {
        width: 100%;
        border-collapse: collapse;
    }
    .table-custom thead th {
        background: var(--surface);
        padding: 0.85rem 1rem;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--navy);
        border-bottom: 2px solid var(--border);
    }
    .table-custom tbody td {
        padding: 0.85rem 1rem;
        vertical-align: middle;
        font-size: 0.85rem;
        border-bottom: 1px solid var(--border);
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="search-card">
                <div class="card-header-custom">
                    <h3>
                        <i class="bi bi-search"></i>
                        Cari & Filter Data Masyarakat
                    </h3>
                </div>
                <div class="card-body p-0">
                    <div class="p-3">
                        <!-- Filter Box -->
                        <div class="filter-box">
                            <form method="GET" action="{{ route('admin.masyarakat.search') }}" class="row g-3 align-items-end">
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold small">Pencarian</label>
                                    <input type="text" class="form-control" name="search" 
                                           value="{{ request('search') }}" 
                                           placeholder="Cari NIK, Nama, atau Desa...">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold small">Desa/Kelurahan</label>
                                    <select class="form-select" name="desa">
                                        <option value="">Semua Desa</option>
                                        @foreach($desaList as $desa)
                                            <option value="{{ $desa }}" {{ request('desa') == $desa ? 'selected' : '' }}>
                                                {{ $desa }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label fw-semibold small">Jenis Kelamin</label>
                                    <select class="form-select" name="jenis_kelamin">
                                        <option value="">Semua</option>
                                        <option value="Laki-laki" {{ request('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="Perempuan" {{ request('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <div class="d-flex gap-2">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-search"></i> Cari
                                        </button>
                                        @if(request()->has('search') || request()->has('desa') || request()->has('jenis_kelamin'))
                                            <a href="{{ route('admin.masyarakat.search') }}" class="btn btn-secondary">
                                                <i class="bi bi-arrow-repeat"></i> Reset
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Hasil Pencarian Info -->
                        @if(request()->has('search') || request()->has('desa') || request()->has('jenis_kelamin'))
                        <div class="result-info">
                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                                <div>
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                    <strong>Hasil Pencarian:</strong> Ditemukan <span class="fw-bold">{{ $data->total() }}</span> data
                                    @if(request('search'))
                                        <span class="badge bg-secondary">Kata kunci: "{{ request('search') }}"</span>
                                    @endif
                                    @if(request('desa'))
                                        <span class="badge bg-secondary">Desa: {{ request('desa') }}</span>
                                    @endif
                                    @if(request('jenis_kelamin'))
                                        <span class="badge bg-secondary">Jenis Kelamin: {{ request('jenis_kelamin') }}</span>
                                    @endif
                                </div>
                                <small class="text-muted">
                                    <i class="bi bi-info-circle"></i> Klik Reset untuk melihat semua data
                                </small>
                            </div>
                        </div>
                        @endif

                        <!-- Table Hasil -->
                        <div class="table-responsive">
                            <table class="table-custom">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="12%">NIK</th>
                                        <th width="18%">Nama Lengkap</th>
                                        <th width="10%">Jenis Kelamin</th>
                                        <th width="15%">Desa/Kelurahan</th>
                                        <th width="12%">No. Telepon</th>
                                        <th width="15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration + ($data->currentPage() - 1) * $data->perPage() }}</td>
                                        <td><code>{{ $item->nik }}</code></td>
                                        <td class="fw-semibold">{{ $item->nama_lengkap }}</td>
                                        <td>{{ $item->jenis_kelamin }}</td>
                                        <td>{{ $item->desa_kelurahan }}</td>
                                        <td>{{ $item->no_telepon ?: '-' }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('admin.masyarakat.show', $item->id) }}" class="btn btn-info btn-sm" title="Detail">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.masyarakat.edit', $item->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-5">
                                            <i class="bi bi-inbox fs-1 text-muted d-block mb-2"></i>
                                            <p class="text-muted mb-0">Tidak ada data ditemukan</p>
                                            <small class="text-muted">Coba gunakan kata kunci yang berbeda</small>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div class="text-muted small">
                                Menampilkan {{ $data->firstItem() ?? 0 }} - {{ $data->lastItem() ?? 0 }} dari {{ $data->total() }} data
                            </div>
                            <div>
                                {{ $data->appends(request()->query())->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection