{{-- resources/views/admin/about/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Manajemen About')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Manajemen About</h1>
        @if(!$about)
            <a href="{{ route('admin.about.create') }}" 
               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                + Tambah Data
            </a>
        @endif
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    @if(session('info'))
        <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mb-6 rounded" role="alert">
            <p>{{ session('info') }}</p>
        </div>
    @endif

    @if($about)
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="p-6">
                <div class="mb-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-2">Deskripsi</h2>
                    <div class="prose max-w-none">
                        {!! nl2br(e($about->deskripsi)) !!}
                    </div>
                </div>

                <div class="mb-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-2">Visi</h2>
                    <div class="prose max-w-none">
                        {!! nl2br(e($about->visi)) !!}
                    </div>
                </div>

                <div class="mb-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-2">Misi</h2>
                    <div class="prose max-w-none">
                        {!! nl2br(e($about->misi)) !!}
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <h3 class="font-bold text-gray-700 mb-1">Alamat</h3>
                        <p class="text-gray-600">{{ $about->alamat }}</p>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-700 mb-1">Telepon</h3>
                        <p class="text-gray-600">{{ $about->telepon ?? '-' }}</p>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-700 mb-1">Email</h3>
                        <p class="text-gray-600">{{ $about->email ?? '-' }}</p>
                    </div>
                </div>

                <div class="flex space-x-3">
                    <a href="{{ route('admin.about.edit', $about->id) }}" 
                       class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-lg transition">
                        Edit Data
                    </a>
                    <button type="button" 
                            onclick="confirmDelete()"
                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-6 rounded-lg transition">
                        Hapus Data
                    </button>
                </div>

                <form id="delete-form" 
                      action="{{ route('admin.about.destroy', $about->id) }}" 
                      method="POST" 
                      style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
    @else
        <div class="bg-yellow-50 border-l-4 border-yellow-500 text-yellow-700 p-6 rounded">
            <p class="font-bold">Belum ada data about</p>
            <p class="mt-2">Silakan klik tombol "Tambah Data" untuk membuat halaman about.</p>
        </div>
    @endif
</div>

<script>
function confirmDelete() {
    if (confirm('Apakah Anda yakin ingin menghapus semua data about? Data ini tidak dapat dikembalikan!')) {
        document.getElementById('delete-form').submit();
    }
}
</script>
@endsection