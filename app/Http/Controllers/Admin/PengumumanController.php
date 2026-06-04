<?php
// app/Http/Controllers/Admin/PengumumanController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PengumumanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengumuman = Pengumuman::orderBy('tanggal', 'desc')->paginate(10);
        return view('admin.pengumuman.index', compact('pengumuman'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pengumuman.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // ✅ Hanya hapus validasi id_admin
        $request->validate([
            'judul' => 'required|min:5|max:200',
            'isi'   => 'required|min:10',
            // 'id_admin' => 'required|exists:admins,id', // HAPUS INI
        ]);

        Pengumuman::create([
            'id_admin' => $request->id_admin,
            'judul'    => $request->judul,
            'isi'      => $request->isi,
            'tanggal'  => Carbon::now(),
        ]);

        return redirect()->route('admin.pengumuman.index')
                         ->with('success', 'Pengumuman berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        return view('admin.pengumuman.show', compact('pengumuman'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        return view('admin.pengumuman.edit', compact('pengumuman'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // ✅ Hanya hapus validasi id_admin
        $request->validate([
            'judul' => 'required|min:5|max:200',
            'isi'   => 'required|min:10',
            // 'id_admin' => 'required|exists:admins,id', // HAPUS INI
        ]);

        $pengumuman = Pengumuman::findOrFail($id);
        
        $pengumuman->update([
            'id_admin' => $request->id_admin,
            'judul'    => $request->judul,
            'isi'      => $request->isi,
        ]);

        return redirect()->route('admin.pengumuman.index')
                         ->with('success', 'Pengumuman berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        $pengumuman->delete();

        return redirect()->route('admin.pengumuman.index')
                         ->with('success', 'Pengumuman berhasil dihapus!');
    }

    /**
     * Display public announcements for users.
     */
    public function publicIndex()
    {
        $pengumuman = Pengumuman::orderBy('tanggal', 'desc')->paginate(15);
        return view('public.Pengumuman.pengumuman', compact('pengumuman'));
    }
}