{{-- resources/views/admin/berita/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Manajemen Berita')

@section('content')

<link rel="stylesheet" href="{{ asset('assets/css/berita.css') }}">

<style>
    /* Tambahan CSS agar pagination rapi dan pindah ke samping */
    .brt-pagination {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1.25rem;
        background: #fff;
        border-top: 1px solid #edf2f7;
    }

    .pagination {
        display: flex;
        gap: 5px;
        margin: 0;
        list-style: none;
    }

    .page-item .page-link {
        padding: 6px 12px;
        border-radius: 8px;
        color: #1a2744;
        text-decoration: none;
        border: 1px solid #e2e8f0;
        transition: all 0.2s;
        font-size: 0.875rem;
    }

    .page-item.active .page-link {
        background-color: #1a2744;
        border-color: #1a2744;
        color: white;
    }

    .page-item.disabled .page-link {
        color: #cbd5e0;
        pointer-events: none;
        background: #f8fafc;
    }

    .page-item:hover:not(.active) .page-link {
        background-color: #f1f5f9;
    }

    @media (max-width: 640px) {
        .brt-pagination {
            flex-direction: column;
            gap: 1rem;
            text-align: center;
        }
    }
</style>

<div class="brt-wrap">
    <div style="max-width:1100px;margin:0 auto;">

        {{-- Header --}}
        <div class="brt-header">
            <div class="brt-header-left">
                <div class="brt-header-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                              d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                    </svg>
                </div>
                <div>
                    <h1>Manajemen Berita</h1>
                    <p>Kelola artikel dan berita instansi</p>
                </div>
            </div>
            <a href="{{ route('admin.berita.create') }}" class="btn-primary">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Berita
            </a>
        </div>

        {{-- Alerts --}}
        @if(session('success'))
        <div class="alert alert-success">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ session('success') }}
        </div>
        @endif

        {{-- Stats --}}
        <div class="stats-strip">
            <div class="stat-card">
                <div class="stat-dot navy"></div>
                <div>
                    <div class="stat-label">Total Data</div>
                    <div class="stat-value">{{ $beritas->total() }}</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-dot green"></div>
                <div>
                    <div class="stat-label">Halaman Saat Ini</div>
                    <div class="stat-value">{{ $beritas->currentPage() }}</div>
                </div>
            </div>
        </div>

        {{-- Table Card --}}
        <div class="brt-card shadow-sm border-0">
            <div style="overflow-x:auto;">
                <table class="brt-table">
                    <thead>
                        <tr>
                            <th style="width:48px">#</th>
                            <th style="width:64px">Gambar</th>
                            <th>Judul Berita</th>
                            <th class="hide-sm" style="width:130px">Penulis</th>
                            <th class="hide-sm" style="width:90px">Dibaca</th>
                            <th style="width:100px">Status</th>
                            <th class="hide-sm" style="width:100px">Tanggal</th>
                            <th style="width:150px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($beritas as $key => $berita)
                        <tr>
                            <td><span class="row-num">{{ $beritas->firstItem() + $key }}</span></td>
                            <td>
                                @if($berita->gambar)
                                    <img src="{{ asset('storage/' . $berita->gambar) }}" class="thumb-img">
                                @else
                                    <div class="thumb-placeholder">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="cell-title">{{ Str::limit($berita->judul, 50) }}</div>
                                <div class="cell-meta">{{ Str::limit(strip_tags($berita->isi), 60) }}</div>
                            </td>
                            <td class="hide-sm"><span class="author-chip">{{ $berita->penulis }}</span></td>
                            <td class="hide-sm"><span class="views-chip">{{ number_format($berita->dibaca) }}</span></td>
                            <td>
                                <span class="badge {{ $berita->status == 'publish' ? 'badge-publish' : 'badge-draft' }}">
                                    <span class="badge-dot"></span>{{ ucfirst($berita->status) }}
                                </span>
                            </td>
                            <td class="hide-sm"><span class="date-cell">{{ $berita->created_at->format('d/m/y') }}</span></td>
                            <td class="action-cell">
                                <a href="{{ route('admin.berita.edit', $berita->id) }}" class="btn-edit">Edit</a>
                                <form action="{{ route('admin.berita.destroy', $berita->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus berita ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-delete">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-5">Tidak ada data berita.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- FOOTER TABLE: PAGINATION (NAVIGASI KE SAMPING) --}}
            <div class="brt-pagination">
                <div class="text-muted small">
                    Menampilkan <b>{{ $beritas->firstItem() }}</b> - <b>{{ $beritas->lastItem() }}</b> dari <b>{{ $beritas->total() }}</b> data
                </div>
                
                <div class="pagination-links">
                    {{ $beritas->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection