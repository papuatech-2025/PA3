{{-- resources/views/admin/berita/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Manajemen Berita')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Lora:ital,wght@0,400;0,600;1,400&display=swap');

    :root {
        --navy:      #1a2744;
        --navy-mid:  #243460;
        --navy-lt:   #2e4080;
        --sky:       #eef2ff;
        --amber:     #d97706;
        --amber-lt:  #fef3c7;
        --ink:       #1e2535;
        --muted:     #6b7280;
        --border:    #e2e8f0;
        --white:     #ffffff;
        --surface:   #f8fafd;
        --danger:    #dc2626;
        --danger-lt: #fef2f2;
        --success:   #16a34a;
        --success-lt:#f0fdf4;
        --draft-bg:  #fffbeb;
        --draft-col: #92400e;
    }

    .brt-wrap * { font-family: 'Plus Jakarta Sans', sans-serif; }

    .brt-wrap {
        background: var(--surface);
        min-height: 100vh;
        padding: 2rem 1.5rem 3rem;
    }

    /* ── Header ── */
    .brt-header {
        display: flex; align-items: flex-end;
        justify-content: space-between;
        gap: 1.5rem; margin-bottom: 2rem;
        flex-wrap: wrap;
    }

    .brt-header-left { display: flex; align-items: center; gap: 1rem; }

    .brt-header-icon {
        width: 52px; height: 52px;
        background: var(--navy);
        border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
        box-shadow: 0 4px 14px rgba(26,39,68,.28);
    }

    .brt-header-icon svg { width: 26px; height: 26px; color: var(--white); }

    .brt-header h1 {
        font-family: 'Lora', serif;
        font-size: 1.8rem; font-weight: 700;
        color: var(--ink); line-height: 1.2; margin: 0;
    }

    .brt-header p { font-size: .82rem; color: var(--muted); margin: .2rem 0 0; }

    .btn-primary {
        display: inline-flex; align-items: center; gap: .45rem;
        padding: .65rem 1.4rem;
        background: var(--navy);
        color: var(--white); border-radius: 10px;
        font-size: .85rem; font-weight: 600;
        text-decoration: none;
        box-shadow: 0 4px 14px rgba(26,39,68,.28);
        transition: background .2s, transform .15s;
        border: none; cursor: pointer; white-space: nowrap;
    }

    .btn-primary:hover { background: var(--navy-lt); transform: translateY(-1px); }
    .btn-primary svg   { width: 16px; height: 16px; }

    /* ── Alerts ── */
    .alert {
        display: flex; align-items: center; gap: .75rem;
        padding: .85rem 1.1rem; border-radius: 10px;
        margin-bottom: 1.25rem; font-size: .85rem; font-weight: 500;
    }

    .alert svg { width: 18px; height: 18px; flex-shrink: 0; }
    .alert-success { background: var(--success-lt); border-left: 4px solid var(--success); color: var(--success); }
    .alert-error   { background: var(--danger-lt);  border-left: 4px solid var(--danger);  color: var(--danger); }

    /* ── Stats strip ── */
    .stats-strip {
        display: flex; gap: 1rem;
        margin-bottom: 1.75rem; flex-wrap: wrap;
    }

    .stat-card {
        flex: 1; min-width: 130px;
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: .9rem 1.1rem;
        display: flex; align-items: center; gap: .75rem;
    }

    .stat-dot { width: 10px; height: 10px; border-radius: 50%; flex-shrink: 0; }
    .stat-dot.navy   { background: var(--navy); }
    .stat-dot.green  { background: #22c55e; }
    .stat-dot.amber  { background: var(--amber); }

    .stat-label { font-size: .72rem; color: var(--muted); font-weight: 500; }
    .stat-value { font-size: 1.35rem; font-weight: 800; color: var(--ink); line-height: 1.1; }

    /* ── Card ── */
    .brt-card {
        background: var(--white);
        border-radius: 16px;
        border: 1px solid var(--border);
        box-shadow: 0 2px 16px rgba(0,0,0,.05);
        overflow: hidden;
    }

    /* ── Table ── */
    .brt-table { width: 100%; border-collapse: collapse; }

    .brt-table thead tr { background: var(--navy); }

    .brt-table thead th {
        padding: 1rem 1.25rem;
        text-align: left;
        font-size: .71rem; font-weight: 700;
        color: rgba(255,255,255,.7);
        text-transform: uppercase; letter-spacing: .07em;
        white-space: nowrap;
    }

    .brt-table thead th:last-child { text-align: right; }

    .brt-table tbody tr {
        border-bottom: 1px solid var(--border);
        transition: background .15s;
    }

    .brt-table tbody tr:last-child { border-bottom: none; }
    .brt-table tbody tr:hover { background: var(--sky); }

    .brt-table td {
        padding: .9rem 1.25rem;
        font-size: .845rem; color: var(--ink);
        vertical-align: middle;
    }

    /* ── Row num ── */
    .row-num {
        width: 28px; height: 28px; border-radius: 8px;
        background: var(--surface); border: 1px solid var(--border);
        display: inline-flex; align-items: center; justify-content: center;
        font-size: .75rem; font-weight: 700; color: var(--muted);
    }

    /* ── Thumbnail ── */
    .thumb-img {
        width: 48px; height: 48px; border-radius: 9px;
        object-fit: cover; border: 1.5px solid var(--border);
        display: block;
    }

    .thumb-placeholder {
        width: 48px; height: 48px; border-radius: 9px;
        background: var(--sky); border: 1.5px dashed var(--border);
        display: flex; align-items: center; justify-content: center;
    }

    .thumb-placeholder svg { width: 20px; height: 20px; color: #93a8c8; }

    /* ── Title cell ── */
    .cell-title { font-weight: 600; color: var(--ink); line-height: 1.35; }
    .cell-meta  { font-size: .74rem; color: var(--muted); margin-top: .2rem; }

    /* ── Author ── */
    .author-chip {
        display: inline-flex; align-items: center; gap: .35rem;
        font-size: .77rem; color: var(--muted); font-weight: 500;
    }

    .author-chip svg { width: 12px; height: 12px; }

    /* ── Views ── */
    .views-chip {
        display: inline-flex; align-items: center; gap: .3rem;
        font-size: .77rem; color: var(--muted); font-weight: 500;
    }

    .views-chip svg { width: 12px; height: 12px; }

    /* ── Status badge ── */
    .badge {
        display: inline-flex; align-items: center; gap: .35rem;
        padding: .28rem .7rem; border-radius: 20px;
        font-size: .74rem; font-weight: 700; white-space: nowrap;
    }

    .badge-publish {
        background: #dcfce7; color: #15803d;
        border: 1px solid #86efac;
    }

    .badge-draft {
        background: var(--draft-bg); color: var(--draft-col);
        border: 1px solid #fcd34d;
    }

    .badge-dot { width: 6px; height: 6px; border-radius: 50%; }
    .badge-publish .badge-dot { background: #22c55e; }
    .badge-draft   .badge-dot { background: var(--amber); }

    /* ── Date ── */
    .date-cell { font-size: .78rem; color: var(--muted); white-space: nowrap; }

    /* ── Actions ── */
    .action-cell { text-align: right; white-space: nowrap; }

    .btn-edit, .btn-delete {
        display: inline-flex; align-items: center; gap: .3rem;
        padding: .35rem .75rem; border-radius: 7px;
        font-size: .78rem; font-weight: 600;
        text-decoration: none; transition: all .15s;
        border: 1px solid transparent;
        cursor: pointer;
        background: none;
    }

    .btn-edit {
        color: var(--navy); border-color: var(--border); background: var(--sky);
    }

    .btn-edit:hover { background: var(--navy); color: var(--white); border-color: var(--navy); }

    .btn-delete {
        color: var(--danger); border-color: #fca5a5;
        background: var(--danger-lt);
    }

    .btn-delete:hover { background: var(--danger); color: var(--white); border-color: var(--danger); }
    .btn-edit svg, .btn-delete svg { width: 13px; height: 13px; }

    /* ── Empty ── */
    .empty-state { padding: 4rem 2rem; text-align: center; }

    .empty-icon {
        width: 70px; height: 70px;
        background: var(--surface); border: 2px dashed var(--border);
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 1.25rem;
    }

    .empty-icon svg  { width: 30px; height: 30px; color: var(--muted); }
    .empty-state h3  { font-size: 1rem; font-weight: 700; color: var(--ink); margin-bottom: .35rem; }
    .empty-state p   { font-size: .83rem; color: var(--muted); margin-bottom: 1.25rem; }

    /* ── Pagination wrapper ── */
    .brt-pagination {
        padding: .9rem 1.25rem;
        background: var(--surface);
        border-top: 1px solid var(--border);
        display: flex; justify-content: space-between; align-items: center;
        font-size: .78rem; color: var(--muted); flex-wrap: wrap; gap: .5rem;
    }

    /* ── Responsive ── */
    @media (max-width: 768px) {
        .brt-header { flex-direction: column; align-items: flex-start; }
        .brt-header h1 { font-size: 1.45rem; }
    }

    @media (max-width: 640px) { .hide-sm { display: none; } }
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
                    <p>Kelola artikel dan berita desa</p>
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
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-error">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ session('error') }}
        </div>
        @endif

        {{-- Stats --}}
        <div class="stats-strip">
            <div class="stat-card">
                <div class="stat-dot navy"></div>
                <div>
                    <div class="stat-label">Total Berita</div>
                    <div class="stat-value">{{ $beritas->total() }}</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-dot green"></div>
                <div>
                    <div class="stat-label">Publish</div>
                    <div class="stat-value">{{ $beritas->getCollection()->where('status','publish')->count() }}</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-dot amber"></div>
                <div>
                    <div class="stat-label">Draft</div>
                    <div class="stat-value">{{ $beritas->getCollection()->where('status','draft')->count() }}</div>
                </div>
            </div>
        </div>

        {{-- Table Card --}}
        <div class="brt-card">
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
                                    <img src="{{ asset('storage/' . $berita->gambar) }}"
                                         alt="{{ $berita->judul }}"
                                         class="thumb-img">
                                @else
                                    <div class="thumb-placeholder">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif
                            </td>

                            <td>
                                <div class="cell-title">{{ Str::limit($berita->judul, 60) }}</div>
                                <div class="cell-meta">{{ Str::limit(strip_tags($berita->isi), 70) }}</div>
                            </td>

                            <td class="hide-sm">
                                <span class="author-chip">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    {{ $berita->penulis }}
                                </span>
                            </td>

                            <td class="hide-sm">
                                <span class="views-chip">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    {{ number_format($berita->dibaca) }}
                                </span>
                            </td>

                            <td>
                                @if($berita->status == 'publish')
                                    <span class="badge badge-publish">
                                        <span class="badge-dot"></span>Publish
                                    </span>
                                @else
                                    <span class="badge badge-draft">
                                        <span class="badge-dot"></span>Draft
                                    </span>
                                @endif
                            </td>

                            <td class="hide-sm">
                                <span class="date-cell">{{ $berita->created_at->format('d M Y') }}</span>
                            </td>

                            {{-- ACTION CELL DENGAN FORM DELETE LANGSUNG --}}
                            <td class="action-cell">
                                <a href="{{ route('admin.berita.edit', $berita->id) }}" class="btn-edit">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Edit
                                </a>
                                
                                {{-- Form Delete Langsung --}}
                                <form action="{{ route('admin.berita.destroy', $berita->id) }}" 
                                      method="POST" 
                                      style="display: inline-block;"
                                      onsubmit="return confirm('Hapus berita &quot;{{ addslashes($berita->judul) }}&quot;? Data tidak dapat dikembalikan.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete" style="margin-left: .4rem;">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 13px; height: 13px;">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                              </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8">
                                <div class="empty-state">
                                    <div class="empty-icon">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                  d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                        </svg>
                                    </div>
                                    <h3>Belum ada berita</h3>
                                    <p>Mulai tambahkan artikel atau berita pertama desa.</p>
                                    <a href="{{ route('admin.berita.create') }}" class="btn-primary" style="font-size:.82rem;padding:.5rem 1.1rem;">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:14px;height:14px;">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                                        </svg>
                                        Tambah Sekarang
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="brt-pagination">
                <span>Menampilkan {{ $beritas->firstItem() }}–{{ $beritas->lastItem() }} dari {{ $beritas->total() }} berita</span>
                {{ $beritas->links() }}
            </div>
        </div>

    </div>
</div>

{{-- Hanya script sederhana untuk console log (opsional) --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Halaman manajemen berita siap digunakan');
    });
</script>

@endsection