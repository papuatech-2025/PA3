<?php
// routes/web.php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\MasyarakatController;
use App\Http\Controllers\Admin\ProgramController as AdminProgramController;
use App\Http\Controllers\Admin\WisataController as AdminWisataController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RekomendasiController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\StrukturController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Import Admin Controllers
use App\Http\Controllers\Admin\AboutController as AdminAboutController;
use App\Http\Controllers\Admin\BeritaController as AdminBeritaController;
use App\Http\Controllers\Admin\LaporanController as AdminLaporanController;
use App\Http\Controllers\Admin\StrukturController as AdminStrukturController;
use App\Http\Controllers\LaporanController;

// 🔥 IMPORT CONTROLLER UNTUK AUTH TERPISAH
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PengumumanController;
use App\Http\Controllers\Admin\VisiMisiController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PesertaKBController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\VisiMisiPublicController;

// =====================================================
// 🔥 ROUTE UNTUK PUBLIC / HALAMAN UMUM
// =====================================================

// Halaman Beranda / Homepage
Route::get('/', [HomeController::class, 'index'])->name('branda');

// ========== PUBLIC LAYANAN ==========
// Route untuk halaman layanan publik (tanpa auth)
Route::prefix('layanan')->name('public.layanan.')->group(function () {
    Route::get('/', [LayananController::class, 'publicIndex'])->name('index');      // Daftar semua layanan
    Route::get('/{id}', [LayananController::class, 'publicShow'])->name('show');     // Detail layanan
});

// ========== PUBLIC BERITA ==========
// Route untuk halaman berita publik
Route::prefix('berita')->name('public.berita.')->group(function () {
    Route::get('/', [BeritaController::class, 'index'])->name('index');     // Daftar semua berita
    Route::get('/{id}', [BeritaController::class, 'show'])->name('show');   // Detail berita
});

// ========== PUBLIC STRUKTUR ==========
// Route untuk halaman struktur organisasi publik
Route::prefix('struktur')->name('public.struktur.')->group(function () {
    Route::get('/', [StrukturController::class, 'index'])->name('index');   // Daftar struktur organisasi
    Route::get('/{id}', [StrukturController::class, 'show'])->name('show'); // Detail anggota struktur
});

// ========== PUBLIC ABOUT / PROFIL ==========
// Route untuk halaman about/profil instansi
Route::prefix('about')->name('public.about.')->group(function () {
    Route::get('/', [AboutController::class, 'index'])->name('index');      // Daftar profil
    Route::get('/{id}', [AboutController::class, 'show'])->name('show');    // Detail profil
});

// Route untuk menampilkan halaman kontak
Route::get('/kontak', [ContactController::class, 'index'])->name('public.kontak');

// Route untuk memproses form pengiriman pesan
Route::post('/kontak/send', [ContactController::class, 'send'])->name('public.kontak.send');
// ========== PUBLIC PROGRAM ==========
// Route untuk halaman program publik
Route::get('/program', [ProgramController::class, 'index'])->name('program.index');       // Daftar program
Route::get('/program/{slug}', [ProgramController::class, 'show'])->name('program.show');  // Detail program

// ========== PUBLIC PENGUMUMAN ==========
Route::get('/pengumuman', [PengumumanController::class, 'publicIndex'])->name('public.pengumuman');

// ========== PUBLIC VISI MISI ==========
// Route untuk halaman visi misi publik (tanpa middleware auth)
Route::get('/visi-misi', [VisiMisiPublicController::class, 'index'])->name('public.visimisi');

// ========== PUBLIC WISATA ==========
// Route untuk detail wisata publik
Route::get('/wisata/{slug}', [RekomendasiController::class, 'detail'])->name('wisata.detail');

// =====================================================
// 🔥 ROUTE UNTUK USER (MASYARAKAT UMUM) - LOGIN/REGISTER
// =====================================================

// Login User
Route::get('/login', [UserAuthController::class, 'showLogin'])->name('user.login');           // Form login user
Route::post('/login', [UserAuthController::class, 'login'])->name('user.login.submit');       // Proses login user

// Register User
Route::get('/register', [UserAuthController::class, 'showRegister'])->name('user.register');     // Form register user
Route::post('/register', [UserAuthController::class, 'register'])->name('user.register.submit'); // Proses register user

// Verifikasi Email User


// Logout User
Route::post('/logout', [UserAuthController::class, 'logout'])->name('user.logout'); // Proses logout user

// ========== USER PROFILE (LOGIN REQUIRED) ==========
// Route yang membutuhkan login sebagai user
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile'); // Halaman profil user
});

// =====================================================
// 🔥 ROUTE UNTUK ADMIN (LOGIN ADMIN SAJA)
// =====================================================

// Route untuk login/register admin (tanpa middleware auth)
Route::prefix('admin')->name('admin.')->group(function () {
    // Login Admin
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');          // Form login admin
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');      // Proses login admin
    
    // Register Admin (dengan kode rahasia)
    Route::get('/register', [AdminAuthController::class, 'showRegister'])->name('register');    // Form register admin
    Route::post('/register', [AdminAuthController::class, 'register'])->name('register.submit'); // Proses register admin
    
    // Verifikasi Email Admin
    Route::get('/verify/{verifyKey}', [AdminAuthController::class, 'verify'])->name('verify');   // Verifikasi email admin
    
    // Logout Admin
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout'); // Proses logout admin
});

// =====================================================
// 🔥 ROUTE UNTUK USER LAPORAN (HANYA USER YANG LOGIN)
// =====================================================

// Route untuk membuat laporan (hanya user yang login)
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('buat-laporan', [LaporanController::class, 'create'])->name('laporan.create'); // Form buat laporan
    Route::post('buat-laporan', [LaporanController::class, 'store'])->name('laporan.store');   // Simpan laporan
});

// Route untuk halaman selesai laporan (tanpa auth)
Route::get('laporan-selesai/{kode}', [LaporanController::class, 'selesai'])->name('laporan.selesai'); // Halaman sukses laporan

// =====================================================
// 🔥 ROUTE UNTUK ADMIN (LOGIN + ROLE ADMIN) - DASHBOARD & CRUD
// =====================================================

// Semua route di bawah ini hanya bisa diakses oleh admin yang sudah login
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // ========== DASHBOARD ADMIN ==========
  Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');// Halaman dashboard admin

    // ========== CRUD LAYANAN (ADMIN) ==========
    // Route resource untuk kelola layanan (lengkap dengan semua method)
    Route::resource('layanan', LayananController::class)->except(['show']);
    
    // Route tambahan untuk layanan
    Route::patch('layanan/{id}/toggle-status', [LayananController::class, 'toggleStatus'])->name('layanan.toggle-status');
    Route::delete('layanan/{id}/delete-image', [LayananController::class, 'deleteImage'])->name('layanan.delete-image');
    Route::post('layanan/{id}/duplicate', [LayananController::class, 'duplicate'])->name('layanan.duplicate');
    Route::post('layanan/bulk-delete', [LayananController::class, 'bulkDelete'])->name('layanan.bulk-delete');
    Route::get('layanan/export/json', [LayananController::class, 'export'])->name('layanan.export');

   
    // ========== CRUD PROGRAM ==========
    Route::resource('program', AdminProgramController::class); // Manage program (index, create, store, edit, update, destroy)

    // ========== CRUD MASYARAKAT ==========
    Route::resource('masyarakat', MasyarakatController::class); // Manage data masyarakat (index, create, store, edit, update, destroy)
    
    // Route tambahan untuk masyarakat (fitur lengkap)
    Route::get('masyarakat/search/filter', [MasyarakatController::class, 'search'])->name('masyarakat.search');           // Cari/filter data masyarakat
    Route::get('masyarakat/archive/data', [MasyarakatController::class, 'archive'])->name('masyarakat.archive');         // Lihat data arsip
    Route::patch('masyarakat/{id}/archive', [MasyarakatController::class, 'moveToArchive'])->name('masyarakat.archive-move'); // Pindah ke arsip
    Route::patch('masyarakat/{id}/restore', [MasyarakatController::class, 'restoreFromArchive'])->name('masyarakat.restore');   // Pulihkan dari arsip
    Route::get('masyarakat/reports/statistics', [MasyarakatController::class, 'reports'])->name('masyarakat.reports');     // Laporan statistik
    Route::get('masyarakat/export/pdf', [MasyarakatController::class, 'exportPdf'])->name('masyarakat.export.pdf');        // Export data ke PDF
    Route::get('masyarakat/export/excel', [MasyarakatController::class, 'exportExcel'])->name('masyarakat.export.excel');  // Export data ke Excel
    Route::patch('/masyarakat/{id}/restore',[MasyarakatController::class, 'restoreFromArchive'])->name('masyarakat.restoreFromArchive');
      // Tambahkan rute untuk Archive dan Restore di sini
    Route::patch('masyarakat/{id}/move-to-archive', [MasyarakatController::class, 'moveToArchive'])
        ->name('masyarakat.moveToArchive');
        
    Route::patch('masyarakat/{id}/restore-from-archive', [MasyarakatController::class, 'restoreFromArchive'])
        ->name('masyarakat.restoreFromArchive');

    // ========== CRUD BERITA ==========
    Route::resource('berita', AdminBeritaController::class); // Manage berita (index, create, store, edit, update, destroy)

    // ========== CRUD STRUKTUR ORGANISASI ==========
    Route::resource('struktur', AdminStrukturController::class); // Manage struktur organisasi (index, create, store, edit, update, destroy)

    // ========== CRUD ABOUT / PROFIL ==========
    Route::resource('about', AdminAboutController::class); // Manage about/profil (index, create, store, edit, update, destroy)

    // ========== CRUD VISI MISI ==========
    Route::resource('visimisi', VisiMisiController::class); // Manage visi misi (index, create, store, edit, update, destroy)

    // ========== LAPORAN ADMIN ==========
    Route::get('laporan', [AdminLaporanController::class, 'index'])->name('laporan.index');               // Daftar laporan masuk
    Route::get('laporan/{id}', [AdminLaporanController::class, 'show'])->name('laporan.show');             // Detail laporan
    Route::put('laporan/{id}/status', [AdminLaporanController::class, 'updateStatus'])->name('laporan.status'); // Update status laporan
    Route::delete('laporan/{id}', [AdminLaporanController::class, 'destroy'])->name('laporan.destroy');    // Hapus laporan
    Route::get('laporan-notifikasi', [AdminLaporanController::class, 'notifikasi'])->name('laporan.notifikasi'); // Notifikasi laporan baru

    // ========== PENGUMUMAN ==========
    Route::resource('pengumuman', PengumumanController::class);

    // =====================================================
    // 🔥 CRUD PESERTA KB (LENGKAP DENGAN SEMUA FITUR)
    // =====================================================
});

// =====================================================
// 🔥 DEBUG ROUTES (UNTUK TESTING - HAPUS SAAT PRODUKSI)
// =====================================================

// Route untuk debug session (cek session pengguna)
Route::get('/debug-session', function() {
    return [
        'auth_check' => Auth::check(),
        'user' => Auth::user(),
        'session_id' => session()->getId(),
        'session_all' => session()->all(),
        'is_admin_route' => request()->is('admin/*')
    ];
});

// Route untuk debug login (cek status login)
Route::get('/debug-login', function() {
    return [
        'session_status' => session_status(),
        'session_id' => session()->getId(),
        'session_data' => session()->all(),
        'auth_check' => Auth::check(),
        'auth_user' => Auth::user(),
        'has_user_model' => class_exists('App\Models\User'),
    ];
});