<?php
// app/Http/Controllers/BeritaController.php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Berita::publish();
        
        // Search berdasarkan judul
        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }
        
        // Filter status (untuk testing/development)
        if ($request->filled('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        
        // Data dengan pagination
        $beritas = $query->orderBy('created_at', 'desc')->paginate(9);
        
        // Berita terbaru untuk featured (5 terbaru)
        $beritaTerbaru = Berita::publish()
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        // Berita populer berdasarkan views terbanyak
        $beritaPopuler = Berita::publish()
            ->orderBy('dibaca', 'desc')
            ->limit(5)
            ->get();
        
        // Data untuk arsip tahun
        $arsipTahun = Berita::publish()
            ->selectRaw('YEAR(created_at) as tahun, COUNT(*) as jumlah')
            ->groupBy('tahun')
            ->orderBy('tahun', 'desc')
            ->get()
            ->pluck('jumlah', 'tahun')
            ->toArray();
        
        // Data kategori (jika ada, bisa dikosongkan dulu)
        $kategoris = collect(); // atau [] jika tidak ada
        
        return view('public.berita.index', compact(
            'beritas', 
            'beritaTerbaru',
            'beritaPopuler',
            'arsipTahun',
            'kategoris'
        ));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $berita = Berita::findOrFail($id);
        
        // Increment pembaca hanya jika status publish
        if ($berita->status == 'publish') {
            $berita->incrementDibaca();
        }
        
        // Berita terkait (rekomendasi)
        $beritaTerkait = Berita::publish()
            ->where('id', '!=', $id)
            ->orderBy('created_at', 'desc')
            ->limit(4)
            ->get();
        
        return view('public.berita.show', compact('berita', 'beritaTerkait'));
    }
}