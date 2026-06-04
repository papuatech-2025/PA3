<?php
// app/Http/Controllers/RekomendasiController.php

namespace App\Http\Controllers;

use App\Models\Wisata;
use Illuminate\Http\Request;

class RekomendasiController extends Controller
{
    public function rekomendasi()
    {
        $wisata = Wisata::aktif()->latest()->get();
        return view('rekomendasi.rekomendasi', compact('wisata'));
    }

    public function detail($slug)
    {
        $wisata = Wisata::where('slug', $slug)->firstOrFail();
        $wisataLain = Wisata::aktif()
            ->where('id', '!=', $wisata->id)
            ->where('kategori', $wisata->kategori)
            ->limit(3)
            ->get();

        // PERHATIKAN INI: Mengarah ke 'Detail.detail-wisata'
        return view('Detail.detail-wisata', compact('wisata', 'wisataLain'));
    }
}