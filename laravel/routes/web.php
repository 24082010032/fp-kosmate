<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KosController;
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
    
    // Halaman Dashboard Utama Pemilik
    Route::get('/dashboard', function () {
        abort_unless(auth()->user()->role === 'pemilik', 403);
        return app(\App\Http\Controllers\KosController::class)->pemilik();
    })->name('dashboard');
    
    // 📊 FITUR BARU: Rute Visualisasi Grafik & Cetak Laporan PDF
    Route::get('/pendapatan/grafik', [KosController::class, 'grafikPendapatan'])->name('pendapatan.grafik');
    Route::get('/laporan/cetak', [KosController::class, 'cetakLaporan'])->name('laporan.cetak');
    
    // Bagian CRUD Kamar (Mengarah ke KosController sesuai revisi database terupdate)
    Route::get('/kamar', [KosController::class, 'index'])->name('kamar.index');
    Route::get('/kamar/create', [KosController::class, 'create'])->name('kamar.create');
    Route::post('/kamar', [KosController::class, 'store'])->name('kamar.store');
    Route::get('/kamar/{id}/edit', [KosController::class, 'edit'])->name('kamar.edit');
    Route::put('/kamar/{id}', [KosController::class, 'update'])->name('kamar.update');
    Route::delete('/kamar/{id}', [KosController::class, 'destroy'])->name('kamar.destroy');
    
    // 🛠️ Rute Visualisasi Denah / Monitoring Real-time Kamar
    Route::get('/kamar/monitoring', [KosController::class, 'monitoringKamar'])->name('kamar.monitoring');
    
    // Kelola data pengguna (Calon Penyewa & Penghuni Aktif)
    Route::get('/users/calon-penyewa', [KosController::class, 'listCalonPenyewa'])->name('users.calon_penyewa');
    Route::get('/users/penghuni', [KosController::class, 'listPenghuni'])->name('users.penghuni');
    
    // Aksi Terima dan Tolak Calon Penyewa
    Route::post('/users/terima/{id}', [KosController::class, 'terimaPenyewa'])->name('users.terima');
    Route::post('/users/tolak/{id}', [KosController::class, 'tolakPenyewa'])->name('users.tolak');
    
    // Aksi verifikasi tombol ubah status tagihan menjadi lunas
    Route::post('/users/penghuni/konfirmasi/{id}', [KosController::class, 'konfirmasiLunas'])->name('users.konfirmasi_lunas');

    // Rute Laporan Komplain Masuk dari Database
    Route::get('/komplains/masuk', [KosController::class, 'listKomplain'])->name('komplains.index');
    
    // Aksi mengubah status komplain menjadi selesai
    Route::post('/komplains/selesai/{id}', [KosController::class, 'komplainSelesai'])->name('komplains.selesai');
    
    // Pengaman rute form buat tagihan di blade pemilik agar tidak error
    Route::post('/tagihans', function () { return back(); })->name('tagihans.store');
    
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
    // Tetap menggunakan KomplainController khusus untuk role user penghuni kos
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