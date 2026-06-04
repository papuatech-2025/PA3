@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-4">

    {{-- Header Section --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
        <div>
            <h2 class="fw-bold mb-1" style="color: #1a237e;">
                <i class="bi bi-grid-fill me-2" style="color: #3949ab;"></i>Kelola Layanan
            </h2>
            <p class="text-muted small mb-0">Manajemen konten dan status layanan website.</p>
        </div>
        <a href="{{ route('admin.layanan.create') }}" class="btn btn-primary rounded-3 px-4 shadow-sm border-0" style="background: #1a237e;">
            <i class="bi bi-plus-lg me-2"></i>Tambah Layanan Baru
        </a>
    </div>

    {{-- Alert Messages --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4">
            <div class="d-flex align-items-center">
                <i class="bi bi-check-circle-fill me-2 fs-5"></i>
                <div>{{ session('success') }}</div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Table Card --}}
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-header bg-white py-3 px-4 border-bottom d-flex justify-content-between align-items-center">
            <span class="text-muted small fw-bold text-uppercase">Daftar Layanan</span>
            <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-2 rounded-pill">
                Total: {{ $layanan->count() }}
            </span>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3 text-muted small fw-bold text-center" width="5%">ID</th>
                            <th class="py-3 text-muted small fw-bold" width="20%">LAYANAN</th>
                            <th class="py-3 text-muted small fw-bold" width="30%">DESKRIPSI</th>
                            <th class="py-3 text-muted small fw-bold text-center">MEDIA</th>
                            <th class="py-3 text-muted small fw-bold text-center">STATUS</th>
                            <th class="py-3 text-muted small fw-bold text-end pe-4">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($layanan as $item)
                        <tr>
                            <td class="text-center text-muted small ps-4">{{ $item->id_layanan }}</td>
                            <td>
                                <div class="fw-bold text-dark">{{ $item->nama_layanan }}</div>
                            </td>
                            <td>
                                <div class="text-muted small text-truncate" style="max-width: 280px;">
                                    {{ Str::limit(strip_tags($item->deskripsi), 80) }}
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    @if($item->icon)
                                        <div class="bg-light rounded-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;" title="Icon: {{ $item->icon }}">
                                            <i class="{{ $item->icon }} text-primary fs-5"></i>
                                        </div>
                                    @endif
                                    @if($item->gambar)
                                        <img src="{{ asset($item->gambar) }}" alt="Img" class="rounded-3 border shadow-sm" style="width: 40px; height: 40px; object-fit: cover;">
                                    @endif
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="form-check form-switch d-inline-block p-0 m-0" style="min-height: auto;">
                                    <input class="form-check-input toggle-status" type="checkbox" 
                                           data-id="{{ $item->id_layanan }}" 
                                           {{ $item->is_active ? 'checked' : '' }}
                                           style="cursor: pointer; width: 2.5em; height: 1.25em;">
                                </div>
                                <div class="mt-1">
                                    <span class="status-badge badge rounded-pill px-2 py-1 {{ $item->is_active ? 'bg-success-subtle text-success border border-success-subtle' : 'bg-danger-subtle text-danger border border-danger-subtle' }}" style="font-size: 0.65rem;">
                                        {{ $item->is_active ? 'AKTIF' : 'NONAKTIF' }}
                                    </span>
                                </div>
                            </td>
                            <td class="text-end pe-4">
                                <div class="btn-group shadow-sm border rounded-3 overflow-hidden">
                                    <a href="{{ route('public.layanan.show', $item->id_layanan) }}" class="btn btn-white btn-sm px-2 border-end" target="_blank" data-bs-toggle="tooltip" title="Lihat Publik">
                                        <i class="bi bi-eye text-info"></i>
                                    </a>
                                    <a href="{{ route('admin.layanan.edit', $item->id_layanan) }}" class="btn btn-white btn-sm px-2 border-end" data-bs-toggle="tooltip" title="Edit">
                                        <i class="bi bi-pencil-square text-warning"></i>
                                    </a>
                                    <button type="button" class="btn btn-white btn-sm px-2 text-danger btn-delete" data-id="{{ $item->id_layanan }}" data-bs-toggle="tooltip" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                                <form id="delete-form-{{ $item->id_layanan }}" action="{{ route('admin.layanan.destroy', $item->id_layanan) }}" method="POST" class="d-none">
                                    @csrf @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="py-4">
                                    <i class="bi bi-inbox fs-1 text-muted opacity-25"></i>
                                    <p class="text-muted mt-2">Belum ada data layanan yang ditambahkan.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-success-subtle { background-color: rgba(25, 135, 84, 0.1) !important; }
    .bg-danger-subtle { background-color: rgba(220, 53, 69, 0.1) !important; }
    .bg-primary-subtle { background-color: rgba(26, 35, 126, 0.1) !important; }
    .btn-white { background: #fff; border: none; transition: 0.2s; }
    .btn-white:hover { background: #f8f9fa; }
    .table thead th {
        background-color: #f8f9fa;
        font-size: 0.7rem;
        letter-spacing: 0.05rem;
        border-bottom: 1px solid #ebedf2;
    }
    /* Switch Adjustment */
    .form-check-input:checked { background-color: #198754; border-color: #198754; }
</style>

{{-- Scripts --}}
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    // 1. Tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    tooltipTriggerList.map(function (el) { return new bootstrap.Tooltip(el) });

    // 2. Toggle Status AJAX
    $('.toggle-status').change(function() {
        const id = $(this).data('id');
        const checkbox = $(this);
        const badge = checkbox.closest('td').find('.status-badge');

        $.ajax({
            url: `/admin/layanan/${id}/toggle-status`,
            type: 'PATCH',
            data: { _token: '{{ csrf_token() }}' },
            success: function(response) {
                if(response.success) {
                    if(response.is_active) {
                        badge.removeClass('bg-danger-subtle text-danger border-danger-subtle')
                             .addClass('bg-success-subtle text-success border-success-subtle')
                             .text('AKTIF');
                    } else {
                        badge.removeClass('bg-success-subtle text-success border-success-subtle')
                             .addClass('bg-danger-subtle text-danger border-danger-subtle')
                             .text('NONAKTIF');
                    }
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000
                    });
                    Toast.fire({ icon: 'success', title: 'Status berhasil diperbarui' });
                }
            },
            error: function() {
                checkbox.prop('checked', !checkbox.prop('checked'));
                Swal.fire('Error', 'Gagal mengubah status layanan', 'error');
            }
        });
    });

    // 3. Delete Confirmation
    $('.btn-delete').click(function() {
        const id = $(this).data('id');
        Swal.fire({
            title: 'Hapus Layanan?',
            text: "Data yang dihapus tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $(`#delete-form-${id}`).submit();
            }
        });
    });
});
</script>
@endpush

@endsection