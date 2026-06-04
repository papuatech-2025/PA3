<?php
// app/Http/Controllers/admin/StrukturController.php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\StrukturOrganisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StrukturController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $strukturs = StrukturOrganisasi::urut()->get();
        return view('admin.struktur.index', compact('strukturs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.struktur.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|min:3|max:100',
            'jabatan' => 'required|min:3|max:100',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'urutan' => 'nullable|integer',
            'aktif' => 'nullable|boolean'
        ]);

        $data = $request->all();
        
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('struktur', 'public');
            $data['foto'] = $fotoPath;
        }

        $data['urutan'] = $request->urutan ?? 0;
        $data['aktif'] = $request->aktif ?? true;

        StrukturOrganisasi::create($data);

        return redirect()->route('admin.struktur.index')
            ->with('success', 'Struktur organisasi berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $struktur = StrukturOrganisasi::findOrFail($id);
        return view('admin.struktur.edit', compact('struktur'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $struktur = StrukturOrganisasi::findOrFail($id);

        $request->validate([
            'nama' => 'required|min:3|max:100',
            'jabatan' => 'required|min:3|max:100',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'urutan' => 'nullable|integer',
            'aktif' => 'nullable|boolean'
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($struktur->foto && Storage::disk('public')->exists($struktur->foto)) {
                Storage::disk('public')->delete($struktur->foto);
            }
            
            $fotoPath = $request->file('foto')->store('struktur', 'public');
            $data['foto'] = $fotoPath;
        }

        $data['urutan'] = $request->urutan ?? 0;
        $data['aktif'] = $request->aktif ?? true;

        $struktur->update($data);

        return redirect()->route('admin.struktur.index')
            ->with('success', 'Struktur organisasi berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $struktur = StrukturOrganisasi::findOrFail($id);
        
        // Hapus foto jika ada
        if ($struktur->foto && Storage::disk('public')->exists($struktur->foto)) {
            Storage::disk('public')->delete($struktur->foto);
        }
        
        $struktur->delete();

        return redirect()->route('admin.struktur.index')
            ->with('success', 'Struktur organisasi berhasil dihapus');
    }
}