<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PengumumanController extends Controller
{
    public function index()
    {
        $pengumuman = Pengumuman::orderBy('tanggal', 'desc')->paginate(10);
        return view('admin.pengumuman.index', compact('pengumuman'));
    }

    public function create()
    {
        return view('admin.pengumuman.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|min:5|max:200',
            'isi'   => 'required|min:10',
        ]);

        Pengumuman::create([
            'id_admin' => Auth::id(),
            'judul'    => $request->judul,
            'isi'      => $request->isi,
            'tanggal'  => Carbon::now(),
        ]);

        return redirect()
            ->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil dibuat!');
    }

    public function show($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        return view('admin.pengumuman.show', compact('pengumuman'));
    }

    public function edit($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        return view('admin.pengumuman.edit', compact('pengumuman'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|min:5|max:200',
            'isi'   => 'required|min:10',
        ]);

        $pengumuman = Pengumuman::findOrFail($id);

        $pengumuman->update([
            'id_admin' => Auth::id(),
            'judul'    => $request->judul,
            'isi'      => $request->isi,
        ]);

        return redirect()
            ->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        $pengumuman->delete();

        return redirect()
            ->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil dihapus!');
    }

    public function publicIndex()
    {
        $pengumuman = Pengumuman::orderBy('tanggal', 'desc')->paginate(15);
        return view('public.Pengumuman.pengumuman', compact('pengumuman'));
    }
}