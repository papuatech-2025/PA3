<?php
// app/Http/Controllers/Admin/WisataController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Wisata;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class WisataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wisata = Wisata::latest()->paginate(10);
        return view('admin.wisata.index', compact('wisata'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.wisata.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'kategori' => 'required',
            'lokasi' => 'required',
            'deskripsi' => 'required',
            'jam_operasional' => 'nullable',
            'harga' => 'nullable|numeric',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'galeri.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'fasilitas' => 'nullable|array',
        ]);

        $data = $request->except(['gambar', 'galeri']);
        
        // Buat slug
        $data['slug'] = Str::slug($request->nama) . '-' . uniqid();

        // Upload gambar utama
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('wisata/gambar', 'public');
        }

        // Upload galeri
        if ($request->hasFile('galeri')) {
            $galeri = [];
            foreach ($request->file('galeri') as $file) {
                $galeri[] = $file->store('wisata/galeri', 'public');
            }
            $data['galeri'] = $galeri;
        }

        Wisata::create($data);

        return redirect()->route('admin.wisata.index')
            ->with('success', 'Data wisata berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Wisata $wisatum)
    {
        return view('admin.wisata.edit', compact('wisatum'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Wisata $wisatum)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'kategori' => 'required',
            'lokasi' => 'required',
            'deskripsi' => 'required',
            'jam_operasional' => 'nullable',
            'harga' => 'nullable|numeric',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'galeri.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'fasilitas' => 'nullable|array',
        ]);

        $data = $request->except(['gambar', 'galeri', '_token', '_method']);

        // Update slug jika nama berubah
        if ($wisatum->nama != $request->nama) {
            $data['slug'] = Str::slug($request->nama) . '-' . uniqid();
        }

        // Upload gambar utama baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($wisatum->gambar) {
                Storage::disk('public')->delete($wisatum->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('wisata/gambar', 'public');
        }

        // Upload galeri baru
        if ($request->hasFile('galeri')) {
            // Hapus galeri lama
            if ($wisatum->galeri) {
                foreach ($wisatum->galeri as $file) {
                    Storage::disk('public')->delete($file);
                }
            }
            
            $galeri = [];
            foreach ($request->file('galeri') as $file) {
                $galeri[] = $file->store('wisata/galeri', 'public');
            }
            $data['galeri'] = $galeri;
        }

        $wisatum->update($data);

        return redirect()->route('admin.wisata.index')
            ->with('success', 'Data wisata berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Wisata $wisatum)
    {
        // Hapus gambar
        if ($wisatum->gambar) {
            Storage::disk('public')->delete($wisatum->gambar);
        }
        
        // Hapus galeri
        if ($wisatum->galeri) {
            foreach ($wisatum->galeri as $file) {
                Storage::disk('public')->delete($file);
            }
        }

        $wisatum->delete();

        return redirect()->route('admin.wisata.index')
            ->with('success', 'Data wisata berhasil dihapus!');
    }
}