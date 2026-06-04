<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // DATA MASYARAKAT
        $totalMasyarakat = DB::table('masyarakat')
            ->where('is_archived', 0)
            ->count();
        
        $masyarakatBaru = DB::table('masyarakat')
            ->where('is_archived', 0)
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();
        
        // DATA KASUS (LAPORAN)
        $totalKasus = DB::table('laporans')->count();
        $kasusPerempuan = 0;
        
        // DATA PROGRAM
        $totalProgram = DB::table('programs')->count();
        $programAktif = DB::table('programs')
            ->where('status', 1)
            ->count();
        
        return view('admin.dashboard', compact(
            'totalMasyarakat',
            'masyarakatBaru',
            'totalKasus',
            'kasusPerempuan',
            'totalProgram',
            'programAktif'
        ));
    }
}