<?php
// app/Http/Controllers/admin/AboutController.php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $about = About::first();
        return view('admin.about.index', compact('about'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $about = About::first();
        if ($about) {
            return redirect()->route('admin.about.index')
                ->with('info', 'Data about sudah ada, silahkan edit saja');
        }
        return view('admin.about.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'deskripsi' => 'required|min:10',
            'visi' => 'required|min:10',
            'misi' => 'required|min:10',
            'alamat' => 'required|min:5',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100'
        ]);

        // Cek apakah sudah ada data
        $existing = About::first();
        if ($existing) {
            return redirect()->route('admin.about.index')
                ->with('error', 'Data about sudah ada, silahkan edit saja');
        }

        About::create($request->all());

        return redirect()->route('admin.about.index')
            ->with('success', 'Data about berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $about = About::findOrFail($id);
        return view('admin.about.edit', compact('about'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $about = About::findOrFail($id);

        $request->validate([
            'deskripsi' => 'required|min:10',
            'visi' => 'required|min:10',
            'misi' => 'required|min:10',
            'alamat' => 'required|min:5',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100'
        ]);

        $about->update($request->all());

        return redirect()->route('admin.about.index')
            ->with('success', 'Data about berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $about = About::findOrFail($id);
        $about->delete();

        return redirect()->route('admin.about.index')
            ->with('success', 'Data about berhasil dihapus');
    }
}