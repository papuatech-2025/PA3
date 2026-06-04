@extends('layouts.app')
@section('content')
<div class="container">
    <h4>Input Visi & Misi</h4>
    <div class="card p-4">
        <form action="{{ route('admin.visimisi.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Isi Visi Misi</label>
                <textarea name="isi" class="form-control" rows="10" placeholder="Tulis visi dan misi di sini..."></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Data</button>
        </form>
    </div>
</div>
@endsection