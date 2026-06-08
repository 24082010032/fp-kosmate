<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KosController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KomplainController;
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
// DASHBOARD PEMILIK KOS
// ==========================================
Route::middleware(['auth'])->prefix('pemilik')->name('pemilik.')->group(function () {
    
    Route::get('/dashboard', function () {
        abort_unless(auth()->user()->role === 'pemilik', 403);
        return app(KosController::class)->pemilik();
    })->name('dashboard');
    
    Route::get('/pendapatan/grafik', [KosController::class, 'grafikPendapatan'])->name('pendapatan.grafik');
    Route::get('/laporan/cetak', [KosController::class, 'cetakLaporan'])->name('laporan.cetak');
    
    // CRUD Kamar
    Route::get('/kamar', [KosController::class, 'index'])->name('kamar.index');
    Route::get('/kamar/create', [KosController::class, 'create'])->name('kamar.create');
    Route::post('/kamar', [KosController::class, 'store'])->name('kamar.store');
    Route::get('/kamar/{id}/edit', [KosController::class, 'edit'])->name('kamar.edit');
    Route::put('/kamar/{id}', [KosController::class, 'update'])->name('kamar.update');
    Route::delete('/kamar/{id}', [KosController::class, 'destroy'])->name('kamar.destroy');
    Route::get('/kamar/monitoring', [KosController::class, 'monitoringKamar'])->name('kamar.monitoring');
    
    // Kelola Users
    Route::get('/users/calon-penyewa', [KosController::class, 'listCalonPenyewa'])->name('users.calon_penyewa');
    Route::get('/users/penghuni', [KosController::class, 'listPenghuni'])->name('users.penghuni');
    Route::post('/users/terima/{id}', [KosController::class, 'terimaPenyewa'])->name('users.terima');
    Route::post('/users/tolak/{id}', [KosController::class, 'tolakPenyewa'])->name('users.tolak');
    Route::post('/users/penghuni/konfirmasi/{id}', [KosController::class, 'konfirmasiLunas'])->name('users.konfirmasi_lunas');
    Route::delete('/users/penghuni/{id}', [KosController::class, 'batalkanSewa'])->name('users.destroy');

    // Komplain
    Route::get('/komplains/masuk', [KosController::class, 'listKomplain'])->name('komplains.index');
    Route::post('/komplains/selesai/{id}', [KosController::class, 'komplainSelesai'])->name('komplains.selesai');
});

// ==========================================
// DASHBOARD PENGHUNI KOS
// ==========================================
Route::middleware(['auth'])->prefix('penghuni')->name('penghuni.')->group(function () {
    Route::get('/dashboard', function () {
        abort_unless(auth()->user()->role === 'penghuni', 403);
        $user = auth()->user();
        $totalTagihan = DB::table('tagihans')->where('user_id', $user->id)->count();
        $totalKomplain = DB::table('komplains')->where('user_id', $user->id)->count();
        return view('roles.penghuni', compact('user', 'totalTagihan', 'totalKomplain'));
    })->name('dashboard');

    Route::get('/komplain', [KomplainController::class, 'index'])->name('komplain.index');
    Route::post('/komplain', [KomplainController::class, 'store'])->name('komplain.store');
    Route::get('/tagihan', fn() => view('roles.tagihan'))->name('tagihan.index');
});

// ==========================================
// DASHBOARD CALON PENYEWA
// ==========================================
Route::middleware(['auth'])->prefix('calon-penyewa')->name('calon-penyewa.')->group(function () {
    Route::get('/dashboard', [KosController::class, 'dashboardCalonPenyewa'])->name('dashboard');
    Route::get('/katalog', [KosController::class, 'katalogKamar'])->name('katalog');
    Route::post('/booking/{id}', [KosController::class, 'prosesBooking'])->name('booking');
    Route::get('/kamar/detail/{id}', [App\Http\Controllers\KosController::class, 'detailKamar'])->name('kamar.detail');
});