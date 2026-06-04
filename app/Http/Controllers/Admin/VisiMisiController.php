<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VisiMisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisiMisiController extends Controller
{
    // TAMPILKAN SEMUA DATA
    public function index()
    {
        $data = VisiMisi::with('admin')->orderBy('created_at', 'desc')->get();
        return view('admin.visimisi.index', compact('data'));
    }

    // FORM TAMBAH
    public function create()
    {
        return view('admin.visimisi.create');
    }

    // SIMPAN DATA BARU
    public function store(Request $request)
    {
        $request->validate(['isi' => 'required']);

        VisiMisi::create([
            'id_admin' => Auth::id(),
            'isi' => $request->isi
        ]);

        return redirect()->route('admin.visimisi.index')->with('success', 'Visi Misi berhasil ditambahkan.');
    }

    // FORM EDIT
    public function edit($id)
    {
        $item = VisiMisi::findOrFail($id);
        return view('admin.visimisi.edit', compact('item'));
    }

    // UPDATE DATA
    public function update(Request $request, $id)
    {
        $request->validate(['isi' => 'required']);

        $item = VisiMisi::findOrFail($id);
        $item->update([
            'id_admin' => Auth::id(),
            'isi' => $request->isi
        ]);

        return redirect()->route('admin.visimisi.index')->with('success', 'Visi Misi berhasil diperbarui.');
    }

    // HAPUS DATA
    public function destroy($id)
    {
        $item = VisiMisi::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.visimisi.index')->with('success', 'Data berhasil dihapus.');
    }
}