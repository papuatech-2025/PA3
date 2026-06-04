{{-- resources/views/admin/about/edit.blade.php --}}
@extends('layouts.app')

@section('title', 'Edit Data About')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Edit Data About</h1>
        <a href="{{ route('admin.about.index') }}" 
           class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
            Kembali
        </a>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('admin.about.update', $about->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label for="deskripsi" class="block text-gray-700 font-bold mb-2">Deskripsi *</label>
                <textarea name="deskripsi" 
                          id="deskripsi" 
                          rows="6"
                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('deskripsi') border-red-500 @enderror"
                          placeholder="Tulis deskripsi tentang organisasi...">{{ old('deskripsi', $about->deskripsi) }}</textarea>
                @error('deskripsi')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="visi" class="block text-gray-700 font-bold mb-2">Visi *</label>
                <textarea name="visi" 
                          id="visi" 
                          rows="4"
                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('visi') border-red-500 @enderror"
                          placeholder="Tulis visi organisasi...">{{ old('visi', $about->visi) }}</textarea>
                @error('visi')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="misi" class="block text-gray-700 font-bold mb-2">Misi *</label>
                <textarea name="misi" 
                          id="misi" 
                          rows="6"
                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('misi') border-red-500 @enderror"
                          placeholder="Tulis misi organisasi (pisahkan dengan baris baru untuk setiap poin)...">{{ old('misi', $about->misi) }}</textarea>
                <p class="text-xs text-gray-500 mt-1">Tips: Tulis setiap misi pada baris baru untuk tampilan yang lebih baik</p>
                @error('misi')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="alamat" class="block text-gray-700 font-bold mb-2">Alamat *</label>
                    <textarea name="alamat" 
                              id="alamat" 
                              rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('alamat') border-red-500 @enderror"
                              placeholder="Masukkan alamat lengkap...">{{ old('alamat', $about->alamat) }}</textarea>
                    @error('alamat')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="telepon" class="block text-gray-700 font-bold mb-2">Telepon</label>
                    <input type="text" 
                           name="telepon" 
                           id="telepon" 
                           value="{{ old('telepon', $about->telepon) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                           placeholder="Contoh: (021) 1234567">
                    @error('telepon')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
                    <input type="email" 
                           name="email" 
                           id="email" 
                           value="{{ old('email', $about->email) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                           placeholder="contoh@email.com">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end space-x-3 mt-6">
                <a href="{{ route('admin.about.index') }}" 
                   class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-6 rounded-lg transition">
                    Batal
                </a>
                <button type="submit" 
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection