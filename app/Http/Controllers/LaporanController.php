<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LaporanController extends Controller
{
   public function create()
    {
        
        return view('public.laporan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pelapor' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_telepon' => 'nullable|string|max:20',
            'jenis_laporan' => 'required|string',
            'judul_laporan' => 'required|string|max:255',
            'isi_laporan' => 'required|string',
            'lokasi_kejadian' => 'nullable|string',
            'tanggal_kejadian' => 'nullable|date',
            'foto_pendukung' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('foto_pendukung')) {
            $data['foto_pendukung'] = $request->file('foto_pendukung')->store('laporan_foto', 'public');
        }

        $laporan = Laporan::create($data);

        return redirect()->route('laporan.selesai', $laporan->kode_laporan)
            ->with('success', 'Laporan berhasil dikirim!');
    }

    public function selesai($kode)
    {
        $laporan = Laporan::where('kode_laporan', $kode)->firstOrFail();
        return view('public.laporan.selesai', compact('laporan'));
    }
}