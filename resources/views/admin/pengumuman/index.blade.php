{{-- resources/views/admin/pengumuman/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Manajemen Pengumuman')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-megaphone-fill"></i> Manajemen Pengumuman</h2>

        <a href="{{ route('admin.pengumuman.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Buat Pengumuman
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header bg-white fw-bold">
            <i class="bi bi-list-ul"></i> Semua Pengumuman
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 5%">ID</th>
                            <th style="width: 25%">Judul</th>
                            <th style="width: 35%">Isi (Preview)</th>
                            <th style="width: 10%">ID Admin</th>
                            <th style="width: 15%">Tanggal</th>
                            <th style="width: 10%">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($pengumuman as $item)
                        <tr>
                            <td>{{ $item->id }}</td>

                            <td class="fw-semibold">
                                {{ Str::limit($item->judul, 40) }}
                            </td>

                            <td>
                                {{ Str::limit(strip_tags($item->isi), 60) }}
                            </td>

                            <td>{{ $item->id_admin }}</td>

                            <td>
                                {{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y H:i') }}
                            </td>

                            <td>
                                {{-- Tombol Edit --}}
                                <a href="{{ route('admin.pengumuman.edit', $item->id) }}"
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                {{-- Tombol Hapus --}}
                                <button type="button"
                                        class="btn btn-sm btn-outline-danger"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $item->id }}">
                                    <i class="bi bi-trash"></i>
                                </button>

                                {{-- Modal Hapus --}}
                                <div class="modal fade"
                                     id="deleteModal{{ $item->id }}"
                                     tabindex="-1">

                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">

                                            <div class="modal-header bg-danger text-white">
                                                <h5 class="modal-title">
                                                    Konfirmasi Hapus
                                                </h5>

                                                <button type="button"
                                                        class="btn-close btn-close-white"
                                                        data-bs-dismiss="modal">
                                                </button>
                                            </div>

                                            <div class="modal-body">
                                                Apakah Anda yakin ingin menghapus pengumuman
                                                <strong>"{{ $item->judul }}"</strong>?
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button"
                                                        class="btn btn-secondary"
                                                        data-bs-dismiss="modal">
                                                    Batal
                                                </button>

                                                <form action="{{ route('admin.pengumuman.destroy', $item->id) }}"
                                                      method="POST"
                                                      class="d-inline">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                            class="btn btn-danger">
                                                        Ya, Hapus
                                                    </button>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>

                                Belum ada pengumuman.
                                Klik "Buat Pengumuman" untuk menambahkan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if($pengumuman->hasPages())
        <div class="card-footer bg-white">
            {{ $pengumuman->links() }}
        </div>
        @endif
    </div>
</div>
@endsection