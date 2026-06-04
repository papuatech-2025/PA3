<?php
// app/Http/Controllers/StrukturController.php

namespace App\Http\Controllers;

use App\Models\StrukturOrganisasi;
use Illuminate\Http\Request;

class StrukturController extends Controller
{
    /**
     * Display a listing of the resource untuk public
     */
    public function index()
    {
        // Ambil semua data yang aktif dan sudah diurutkan
        $strukturs = StrukturOrganisasi::aktif()
            ->urut()
            ->get();
        
        // Pisahkan berdasarkan jabatan
        $pimpinan = $strukturs->filter(function($item) {
            $jabatan = strtolower($item->jabatan);
            return str_contains($jabatan, 'kepala') || 
                   str_contains($jabatan, 'ketua') || 
                   str_contains($jabatan, 'pimpinan');
        })->first();
        
        $wakil = $strukturs->filter(function($item) {
            $jabatan = strtolower($item->jabatan);
            return str_contains($jabatan, 'wakil');
        })->first();
        
        $sekretaris = $strukturs->filter(function($item) {
            $jabatan = strtolower($item->jabatan);
            return str_contains($jabatan, 'sekretaris');
        })->first();
        
        $bendahara = $strukturs->filter(function($item) {
            $jabatan = strtolower($item->jabatan);
            return str_contains($jabatan, 'bendahara');
        })->first();
        
        // Anggota lainnya (bukan pimpinan, wakil, sekretaris, bendahara)
        $anggota = $strukturs->reject(function($item) use ($pimpinan, $wakil, $sekretaris, $bendahara) {
            return $item->id == ($pimpinan?->id ?? 0) ||
                   $item->id == ($wakil?->id ?? 0) ||
                   $item->id == ($sekretaris?->id ?? 0) ||
                   $item->id == ($bendahara?->id ?? 0);
        });
        
        return view('public.struktur.index', compact(
            'strukturs', 
            'pimpinan', 
            'wakil', 
            'sekretaris', 
            'bendahara', 
            'anggota'
        ));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $struktur = StrukturOrganisasi::aktif()->findOrFail($id);
        return view('public.struktur.show', compact('struktur'));
    }
}