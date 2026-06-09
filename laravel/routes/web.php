<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KosController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KomplainController;
use App\Http\Controllers\TagihanController;

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
    })->name('home');
    
    Route::resource('kamar', KamarController::class)->except(['show']);
    
    Route::get('/users/calon-penyewa', [KosController::class, 'listCalonPenyewa'])->name('users.calon_penyewa');
    Route::post('/tagihans', function () { return back(); })->name('tagihans.store');
    
    Route::get('/settings', function () {
        abort_unless(auth()->user()->role === 'pemilik', 403);
        return view('pemilik.settings');
    })->name('settings');
});

// ==========================================
// DASHBOARD PENGHUNI KOS (FITUR LENGKAP & AMAN REVISI)
// ==========================================
Route::middleware('auth')->prefix('penghuni')->name('penghuni.')->group(function () {
    
    // 1. Dashboard Informasi Kamar (Sudah Rapi & Bersih Tanpa Kotak Putih)
    Route::get('/dashboard', function () {
        abort_unless(auth()->user()->role === 'penghuni', 403);
        
        $user = auth()->user(); 
        
        // Mengambil data riwayat pembayaran & komplain asli dari database
        $riwayatBayar = \Illuminate\Support\Facades\DB::table('pembayarans')->where('user_id', $user->id)->latest()->get();
        $riwayatKomplain = \Illuminate\Support\Facades\DB::table('komplains')->where('user_id', $user->id)->latest()->get();
        
        // Statistik untuk box dashboard
        $totalTagihan = \Illuminate\Support\Facades\DB::table('tagihans')->where('user_id', $user->id)->count();
        $totalKomplain = $riwayatKomplain->count();
        
        // Data static informasi kamar
        $infoKamar = [
            'nomor_kamar' => 'A-03', 
            'jatuh_tempo' => date('Y-m-d', strtotime('+1 month')),
            'harga' => 1500000
        ];

        // Datanya tetap diambil di background biar tidak hilang
        $tesSession = session('info_tes_session');
        $waktuMasuk = session('waktu_masuk');
        $tesCookie = request()->cookie('cookie_user_kosmate');
        
        // Dikirim secara aman ke file Blade tanpa merusak tampilan HTML luar
        return view('roles.penghuni', compact('user', 'totalTagihan', 'totalKomplain', 'infoKamar', 'riwayatBayar', 'riwayatKomplain', 'tesSession', 'waktuMasuk', 'tesCookie'));
    })->name('dashboard');

    // 2. Upload Bukti Pembayaran (DIALIKKAN KE TagihanController)
    Route::post('/upload-pembayaran', [TagihanController::class, 'uploadPembayaran'])->name('upload_pembayaran');

    // 4. Cetak Kuitansi Digital (DIALIKKAN KE TagihanController)
    Route::get('/kuitansi/{id}/cetak', [TagihanController::class, 'cetakKuitansi'])->name('cetak_kuitansi');

    // 3. Formulir Komplain Fasilitas (DIALIKKAN KE KomplainController)
    Route::post('/kirim-komplain', [KomplainController::class, 'kirimKomplain'])->name('kirim_komplain');
    Route::post('/komplain', [KomplainController::class, 'kirimKomplain'])->name('komplain.store');
    Route::post('/komplains-typo', [KomplainController::class, 'kirimKomplain'])->name('komplains.store'); 

    // JALUR TAGIHAN LAMA
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

    Route::post('/booking/{kamar_id}', [KosController::class, 'prosesBooking'])->name('booking.store');
});