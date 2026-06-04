{{-- resources/views/admin/struktur/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Manajemen Struktur Organisasi')

@section('content')
<style>
    :root {
        --primary: #1a4731;
        --primary-light: #2d7a54;
        --accent: #c9a84c;
        --bg-light: #f8fafc;
        --text-main: #1e293b;
        --text-muted: #64748b;
    }

    .so-container {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: var(--bg-light);
        padding: 1.5rem;
    }

    /* Page Header */
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    .page-title h1 {
        font-family: 'Lora', serif;
        font-weight: 700;
        font-size: 1.75rem;
        color: var(--primary);
        margin: 0;
    }

    /* Stat Cards Modern */
    .stat-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .stat-card-premium {
        background: white;
        padding: 1.25rem;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        gap: 1rem;
        transition: transform 0.2s;
    }

    .stat-card-premium:hover { transform: translateY(-3px); }

    .stat-icon {
        width: 48px; height: 48px;
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.25rem;
    }

    /* Table Styling */
    .table-card {
        background: white;
        border-radius: 20px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
        overflow: hidden;
    }

    .custom-table { width: 100%; border-collapse: collapse; }
    .custom-table thead { background: #f1f5f9; }
    .custom-table th {
        padding: 1rem 1.5rem;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--text-muted);
        font-weight: 700;
        border-bottom: 1px solid #e2e8f0;
    }

    .custom-table td {
        padding: 1.25rem 1.5rem;
        vertical-align: middle;
        border-bottom: 1px solid #f1f5f9;
    }

    /* Avatar */
    .avatar-circle {
        width: 45px; height: 45px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #f1f5f9;
    }

    /* Badges */
    .badge-pill {
        padding: 0.4rem 0.8rem;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
    }

    .badge-success { background: #ecfdf5; color: #059669; }
    .badge-danger { background: #fef2f2; color: #dc2626; }

    /* Action Buttons */
    .btn-action {
        width: 32px; height: 32px;
        display: inline-flex; align-items: center; justify-content: center;
        border-radius: 8px;
        transition: all 0.2s;
        border: 1px solid #e2e8f0;
        background: white;
        color: var(--text-main);
    }

    .btn-action:hover { background: var(--primary); color: white; border-color: var(--primary); }
    .btn-delete:hover { background: #dc2626; color: white; border-color: #dc2626; }

</style>

<div class="so-container">
    <div class="page-header">
        <div class="page-title">
            <h1>Struktur Organisasi</h1>
            <p class="text-muted small">Kelola hierarki dan anggota dinas secara efisien</p>
        </div>
        <a href="{{ route('admin.struktur.create') }}" class="btn btn-primary shadow-sm" style="background: var(--primary); border: none; border-radius: 12px; padding: 0.75rem 1.5rem;">
            <i class="fas fa-plus me-2"></i> Tambah Anggota
        </a>
    </div>

    <div class="stat-grid">
        <div class="stat-card-premium">
            <div class="stat-icon" style="background: #f0fdf4; color: #16a34a;"><i class="fas fa-users"></i></div>
            <div>
                <div class="small text-muted">Total Anggota</div>
                <div class="h5 fw-bold mb-0">{{ $strukturs->count() }}</div>
            </div>
        </div>
        <div class="stat-card-premium">
            <div class="stat-icon" style="background: #fefce8; color: #ca8a04;"><i class="fas fa-user-tie"></i></div>
            <div>
                <div class="small text-muted">Jabatan Aktif</div>
                <div class="h5 fw-bold mb-0">{{ $strukturs->where('aktif', 1)->count() }}</div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4" style="border-radius: 12px;">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="table-card">
        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th class="text-center" width="50">#</th>
                        <th>Anggota</th>
                        <th>Jabatan</th>
                        <th class="text-center">Urutan</th>
                        <th class="text-center">Status</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($strukturs as $key => $struktur)
                    <tr>
                        <td class="text-center text-muted small">{{ $key + 1 }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                @if($struktur->foto)
                                    <img src="{{ asset('storage/' . $struktur->foto) }}" class="avatar-circle">
                                @else
                                    <div class="avatar-circle d-flex align-items-center justify-content-center bg-light text-muted">
                                        <i class="fas fa-user"></i>
                                    </div>
                                @endif
                                <div>
                                    <div class="fw-bold text-dark">{{ $struktur->nama }}</div>
                                    <div class="small text-muted">ID: #{{ $struktur->id }}</div>
                                </div>
                            </div>
                        </td>
                        <td><span class="fw-medium" style="color: var(--primary);">{{ $struktur->jabatan }}</span></td>
                        <td class="text-center">
                            <span class="badge bg-light text-dark border">{{ $struktur->urutan }}</span>
                        </td>
                        <td class="text-center">
                            @if($struktur->aktif)
                                <span class="badge-pill badge-success"><span style="width:6px;height:6px;background:#059669;border-radius:50%"></span> Aktif</span>
                            @else
                                <span class="badge-pill badge-danger"><span style="width:6px;height:6px;background:#dc2626;border-radius:50%"></span> Nonaktif</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.struktur.edit', $struktur->id) }}" class="btn-action" title="Edit">
                                    <i class="fas fa-edit fa-xs"></i>
                                </a>
                                <form action="{{ route('admin.struktur.destroy', $struktur->id) }}" method="POST" onsubmit="return confirm('Hapus data ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete" title="Hapus">
                                        <i class="fas fa-trash fa-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection