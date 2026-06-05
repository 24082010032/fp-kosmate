<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KosController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KomplainController;

// ==========================================
// RUTE AUTENTIKASI (LOGIN & REGISTER)
// ==========================================
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Halaman Utama / Landing Page
Route::get('/', [KosController::class, 'welcome'])->name('welcome');

// ==========================================
// DASHBOARD PEMILIK KOS
// ==========================================
Route::middleware('auth')->prefix('pemilik')->name('pemilik.')->group(function () {
    Route::get('/dashboard', function () {
        abort_unless(auth()->user()->role === 'pemilik', 403);
        return app(\App\Http\Controllers\KosController::class)->pemilik();
    })->name('dashboard');
    
    Route::resource('kamar', KamarController::class)->except(['show']);
    
    // 🟢 SIKAT SINKRON KE CONTROLLER (Udah gak digembok teks dummy lagi)
    Route::get('/users/calon-penyewa', [KosController::class, 'listCalonPenyewa'])->name('users.calon_penyewa');
    
    // Pengaman rute form buat tagihan di blade pemilik agar tidak eror
    Route::post('/tagihans', function () { return back(); })->name('tagihans.store');
    
    Route::get('/settings', function () {
        abort_unless(auth()->user()->role === 'pemilik', 403);
        return view('pemilik.settings');
    })->name('settings');
});

// ==========================================
// DASHBOARD PENGHUNI KOS (KEBAL TYPO "S" & FIX DATA)
// ==========================================
Route::middleware('auth')->prefix('penghuni')->name('penghuni.')->group(function () {
    
    // Rute Dashboard Penghuni (Kirim data lengkap ke blade)
    Route::get('/dashboard', function () {
        abort_unless(auth()->user()->role === 'penghuni', 403);
        
        $user = auth()->user(); 
        
        // Ambil data jumlah asli dari database biar sinkron sama tampilan box dashboard
        $totalTagihan = \Illuminate\Support\Facades\DB::table('tagihans')->where('user_id', $user->id)->count();
        $totalKomplain = \Illuminate\Support\Facades\DB::table('komplains')->where('user_id', $user->id)->count();
        
        return view('roles.penghuni', compact('user', 'totalTagihan', 'totalKomplain'));
    })->name('dashboard');

    // JALUR KOMPLAIN (Ganda: Mengatasi typo 'komplain' vs 'komplains' di Blade)
    Route::get('/komplain', [KomplainController::class, 'index'])->name('komplain.index');
    Route::post('/komplain', [KomplainController::class, 'store'])->name('komplain.store');
    Route::post('/komplains-typo', [KomplainController::class, 'store'])->name('komplains.store'); 

    // JALUR TAGIHAN (Ganda: Mengatasi 'tagihan' vs 'tagihans' di Blade)
    Route::get('/tagihan', function () { 
        return view('roles.tagihan'); 
    })->name('tagihan.index');
    Route::get('/tagihans-typo', function () { 
        return view('roles.tagihan'); 
    })->name('tagihans.index');
});

// ==========================================
// DASHBOARD CALON PENYEWA
// ==========================================
Route::middleware('auth')->prefix('calon-penyewa')->name('calon-penyewa.')->group(function () {
    Route::get('/dashboard', function () {
        abort_unless(auth()->user()->role === 'calon_penyewa', 403);
        return app(\App\Http\Controllers\KosController::class)->calonPenyewa();
    })->name('dashboard');
});