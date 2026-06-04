<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index(Request $request)
    {
        $query = Program::where('status', true); // Hanya tampilkan program aktif
        
        // Filter kategori
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }
        
        // Search
        if ($request->filled('search')) {
            $query->where('nama_program', 'like', '%' . $request->search . '%');
        }
        
        $programs = $query->latest()->paginate(9);
        
        return view('public.program.index', compact('programs'));
    }
    
    public function show($slug)
    {
        $program = Program::where('slug', $slug)->firstOrFail();
        
        return view('public.program.show', compact('program'));
    }
}