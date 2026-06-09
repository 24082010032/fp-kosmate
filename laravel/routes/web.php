<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KosController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KomplainController;
use App\Http\Controllers\TagihanController;
use Illuminate\Support\Facades\DB;

// ==========================================
// RUTE AUTENTIKASI
// ==========================================
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [KosController::class, 'welcome'])->name('welcome');

// ==========================================
// DASHBOARD PEMILIK KOS (GABUNGAN FITUR DINDA & DHEA)
// ==========================================
Route::middleware(['auth'])->prefix('pemilik')->name('pemilik.')->group(function () {
    
    Route::get('/dashboard', function () {
        abort_unless(auth()->user()->role === 'pemilik', 403);
        return app(KosController::class)->pemilik();
    })->name('dashboard');
    
    Route::get('/pendapatan/grafik', [KosController::class, 'grafikPendapatan'])->name('pendapatan.grafik');
    Route::get('/laporan/cetak', [KosController::class, 'cetakLaporan'])->name('laporan.cetak');
    
    // CRUD Kamar (Fitur Dhea)
    Route::get('/kamar', [KosController::class, 'index'])->name('kamar.index');
    Route::get('/kamar/create', [KosController::class, 'create'])->name('kamar.create');
    Route::post('/kamar', [KosController::class, 'store'])->name('kamar.store');
    Route::get('/kamar/{id}/edit', [KosController::class, 'edit'])->name('kamar.edit');
    Route::put('/kamar/{id}', [KosController::class, 'update'])->name('kamar.update');
    Route::delete('/kamar/{id}', [KosController::class, 'destroy'])->name('kamar.destroy');
    Route::get('/kamar/monitoring', [KosController::class, 'monitoringKamar'])->name('kamar.monitoring');
    
    // Kelola Users & Verifikasi Sewa (Fitur Dhea & Dinda)
    Route::get('/users/calon-penyewa', [KosController::class, 'listCalonPenyewa'])->name('users.calon_penyewa');
    Route::get('/users/penghuni', [KosController::class, 'listPenghuni'])->name('users.penghuni');
    Route::post('/users/terima/{id}', [KosController::class, 'terimaPenyewa'])->name('users.terima');
    Route::post('/users/tolak/{id}', [KosController::class, 'tolakPenyewa'])->name('users.tolak');
    Route::post('/users/penghuni/konfirmasi/{id}', [KosController::class, 'konfirmasiLunas'])->name('users.konfirmasi_lunas');
    Route::delete('/users/penghuni/{id}', [KosController::class, 'batalkanSewa'])->name('users.destroy');
    Route::post('/tagihans', function () { return back(); })->name('tagihans.store');

    // Komplain Masuk Ke Pemilik (Fitur Dhea)
    Route::get('/komplains/masuk', [KosController::class, 'listKomplain'])->name('komplains.index');
    Route::post('/komplains/selesai/{id}', [KosController::class, 'komplainSelesai'])->name('komplains.selesai');
    
    Route::get('/settings', function () {
        abort_unless(auth()->user()->role === 'pemilik', 403);
        return view('pemilik.settings');
    })->name('settings');
});

// ==========================================
// DASHBOARD PENGHUNI KOS (REVISI DINDA - FITUR SINKRON)
// ==========================================
Route::middleware(['auth'])->prefix('penghuni')->name('penghuni.')->group(function () {
    
    Route::get('/dashboard', function () {
        abort_unless(auth()->user()->role === 'penghuni', 403);
        $user = auth()->user(); 
        
        $riwayatBayar = DB::table('pembayarans')->where('user_id', $user->id)->latest()->get();
        $riwayatKomplain = DB::table('komplains')->where('user_id', $user->id)->latest()->get();
        
        $totalTagihan = DB::table('tagihans')->where('user_id', $user->id)->count();
        $totalKomplain = $riwayatKomplain->count();
        
        $infoKamar = [
            'nomor_kamar' => 'A-03', 
            'jatuh_tempo' => date('Y-m-d', strtotime('+1 month')),
            'harga' => 1500000
        ];

        $tesSession = session('info_tes_session');
        $waktuMasuk = session('waktu_masuk');
        $tesCookie = request()->cookie('cookie_user_kosmate');
        
        return view('roles.penghuni', compact('user', 'totalTagihan', 'totalKomplain', 'infoKamar', 'riwayatBayar', 'riwayatKomplain', 'tesSession', 'waktuMasuk', 'tesCookie'));
    })->name('dashboard');

    Route::get('/komplain', [KomplainController::class, 'index'])->name('komplain.index');
    Route::post('/upload-pembayaran', [TagihanController::class, 'uploadPembayaran'])->name('upload_pembayaran');
    Route::get('/kuitansi/{id}/cetak', [TagihanController::class, 'cetakKuitansi'])->name('cetak_kuitansi');
    Route::post('/kirim-komplain', [KomplainController::class, 'kirimKomplain'])->name('kirim_komplain');
    Route::post('/komplain', [KomplainController::class, 'store'])->name('komplain.store');
    Route::post('/komplains-typo', [KomplainController::class, 'kirimKomplain'])->name('komplains.store'); 
    Route::get('/tagihan', fn() => view('roles.tagihan'))->name('tagihan.index');
    Route::get('/tagihans-typo', function () { return view('roles.tagihan'); })->name('tagihans.index');
});

// ==========================================
// DASHBOARD CALON PENYEWA (GABUNGAN DINDA & DHEA)
// ==========================================
Route::middleware(['auth'])->prefix('calon-penyewa')->name('calon-penyewa.')->group(function () {
    Route::get('/dashboard', [KosController::class, 'dashboardCalonPenyewa'])->name('dashboard');
    Route::get('/katalog', [KosController::class, 'katalogKamar'])->name('katalog');
    Route::post('/booking/{id}', [KosController::class, 'prosesBooking'])->name('booking');
    Route::get('/kamar/detail/{id}', [KosController::class, 'detailKamar'])->name('kamar.detail');
    Route::post('/booking-lama/{kamar_id}', [KosController::class, 'prosesBooking'])->name('booking.store');
});