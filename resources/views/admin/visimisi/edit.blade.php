@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Edit Visi & Misi</h1>
    
    <div class="card mb-4 border-warning">
        <div class="card-body">
            <form action="{{ route('admin.visimisi.update', $item->id_visimisi) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="isi" class="form-label fw-bold">Konten Visi & Misi</label>
                    <textarea name="isi" id="isi" class="form-control" rows="12" required>{{ old('isi', $item->isi) }}</textarea>
                    <small class="text-muted">Terakhir diubah oleh: {{ $item->admin->username ?? 'Admin' }}</small>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-save"></i> Perbarui Data
                    </button>
                    <a href="{{ route('admin.visimisi.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Opsional: Tambahkan CKEditor agar pengeditan lebih mudah -->
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('isi');
</script>
@endsection