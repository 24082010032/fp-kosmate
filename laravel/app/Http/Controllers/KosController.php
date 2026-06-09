<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kamar;
use App\Models\User; 
use App\Models\Komplain; 
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Schema;

class KosController extends Controller
{
    public function welcome()
    {
        if (Auth::check()) {
            return redirect()->route(Auth::user()->role . '.dashboard');
        }

        return view('auth.landing');
    }

    public function calonPenyewa()
    {
        if (!Auth::check()) {
            return Redirect::route('login')->with('error', 'Silakan login atau daftar untuk melihat kamar.');
        }

        if (Auth::user()->role !== 'calon_penyewa') {
            abort(403);
        }

        $kamars = Kamar::where('status', 'Tersedia')->get();
        return view('roles.calon-penyewa', compact('kamars'));
    }

    public function penghuni()
    {
        if (!Auth::check() || Auth::user()->role !== 'penghuni') {
            abort(403);
        }
        return view('roles.penghuni');
    }

    public function pemilik()
    {
        if (!Auth::check() || Auth::user()->role !== 'pemilik') {
            abort(403);
        }

        // 1. Hitung kamar dengan status 'Tersedia'
        $kamarTersedia = Kamar::where('status', 'Tersedia')->count();

        // 2. Hitung user yang rolenya 'penghuni'
        $penghuniAktif = User::where('role', 'penghuni')->count();

        // 3. Menghitung total seluruh komplain agar sinkron dengan daftar komplain masuk
        $komplainBaru = Komplain::count();

        return view('roles.pemilik', compact('kamarTersedia', 'penghuniAktif', 'komplainBaru'));
    }

    public function listCalonPenyewa()
    {
        if (!Auth::check() || Auth::user()->role !== 'pemilik') {
            abort(403);
        }

        $users = User::where('role', 'calon_penyewa')->get();

        return view('pemilik.users_calon_penyewa', compact('users'));
    }

    // ==========================================
    // BAGIAN CRUD KAMAR (REVISI: MENGGUNAKAN DATABASE)
    // ==========================================
    public function index()
    {
        if (!Auth::check() || Auth::user()->role !== 'pemilik') {
            abort(403);
        }

        // REVISI: Ambil data riil dari database, bukan dummy array lagi
        $kamar = Kamar::all();

        return view('pemilik.kamar.index', compact('kamar'));
    }

    public function create()
    {
        if (!Auth::check() || Auth::user()->role !== 'pemilik') {
            abort(403);
        }

        return view('pemilik.kamar.create');
    }

    public function store(Request $request)
    {
        if (!Auth::check() || Auth::user()->role !== 'pemilik') {
            abort(403);
        }

        // REVISI: Validasi disesuaikan dengan struktur asli tabel kamars kamu
        $request->validate([
            'tipe_kamar' => 'required|string|max:255',
            'harga'      => 'required|numeric',
            'status'     => 'required|in:Tersedia,Terisi',
            'fasilitas'  => 'nullable|string',
            'foto'       => 'nullable|string',
        ]);

        Kamar::create($request->all());

        return redirect()->route('pemilik.kamar.index')->with('message', 'Kamar berhasil ditambahkan.');
    }

    public function edit(int $id) 
    {
        if (!Auth::check() || Auth::user()->role !== 'pemilik') {
            abort(403);
        }

        // REVISI: Ambil data riil berdasarkan id dari database
        $kamar = Kamar::findOrFail($id);

        return view('pemilik.kamar.edit', compact('kamar'));
    }

    public function update(Request $request, int $id) 
    {
        if (!Auth::check() || Auth::user()->role !== 'pemilik') {
            abort(403);
        }

        // REVISI: Validasi disesuaikan dengan struktur asli tabel kamars kamu
        $request->validate([
            'tipe_kamar' => 'required|string|max:255',
            'harga'      => 'required|numeric',
            'status'     => 'required|in:Tersedia,Terisi',
            'fasilitas'  => 'nullable|string',
            'foto'       => 'nullable|string',
        ]);

        $kamar = Kamar::findOrFail($id);
        $kamar->update($request->all());

        return redirect()->route('pemilik.kamar.index')->with('message', 'Kamar berhasil diupdate.');
    }

    public function destroy(int $id) 
    {
        if (!Auth::check() || Auth::user()->role !== 'pemilik') {
            abort(403);
        }

        $kamar = Kamar::findOrFail($id);
        $kamar->delete();

        return redirect()->route('pemilik.kamar.index')->with('message', 'Kamar berhasil dihapus.');
    }

    public function terimaPenyewa(int $id)
    {
        if (Auth::user()->role !== 'pemilik') {
            abort(403);
        }

        $user = User::findOrFail($id);
        $user->role = 'penghuni';
        $user->save();

        return redirect()->back()->with('message', "Berhasil menerima {$user->name} sebagai penghuni kos!");
    }

    public function tolakPenyewa(int $id)
    {
        if (Auth::user()->role !== 'pemilik') {
            abort(403);
        }

        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('message', "Pendaftaran {$user->name} telah ditolak.");
    }

    public function listPenghuni()
    {
        if (!Auth::check() || Auth::user()->role !== 'pemilik') {
            abort(403);
        }

        $users = User::where('role', 'penghuni')->get();

        return view('pemilik.users_penghuni', compact('users'));
    }

    public function konfirmasiLunas(int $id)
    {
        if (!Auth::check() || Auth::user()->role !== 'pemilik') {
            abort(403);
        }

        $user = User::findOrFail($id);
        $user->status_tagihan = 'lunas';
        $user->save();

        return redirect()->back()->with('success', 'Pembayaran ' . $user->name . ' berhasil diverifikasi sebagai LUNAS!');
    }

    // ==========================================
    // KELOLA LAPORAN KOMPLAIN
    // ==========================================
    public function listKomplain()
    {
        if (!Auth::check() || Auth::user()->role !== 'pemilik') {
            abort(403);
        }

        $komplains = DB::table('komplains')
            ->join('users', 'komplains.user_id', '=', 'users.id')
            ->select('komplains.*', 'users.name as user_name')
            ->orderBy('komplains.id', 'desc')
            ->get();

        return view('pemilik.komplain_index', compact('komplains'));
    }

    public function komplainSelesai(int $id)
    {
        if (!Auth::check() || Auth::user()->role !== 'pemilik') {
            abort(403);
        }

        DB::table('komplains')
            ->where('id', $id)
            ->update(['status' => 'Selesai']);

        return redirect()->back()->with('success', 'Status komplain berhasil diperbarui menjadi Selesai!');
    }

    // ==========================================
    // MONITORING VISUAL KAMAR (SINKRON DATA ASLI)
    // ==========================================
    public function monitoringKamar()
    {
        if (!Auth::check() || Auth::user()->role !== 'pemilik') {
            abort(403);
        }

        $allKamars = Kamar::with('penghuni')->get();

        $totalKamar = $allKamars->count();
        $sisaKosong = $allKamars->where('status', 'Tersedia')->count();

        return view('pemilik.kamar_monitoring', compact('allKamars', 'totalKamar', 'sisaKosong'));
    }

    // ==========================================
    // REVISI AKURASI DATA: GRAPHIC FEATURE & PRINT REPORT
    // ==========================================
    public function grafikPendapatan()
    {
        if (!Auth::check() || Auth::user()->role !== 'pemilik') {
            abort(403);
        }

        // Mengambil akumulasi total pendapatan aktif (kamar terisi)
        $totalPemasukan = Kamar::where('status', 'Terisi')->sum('harga');

        return view('pemilik.pendapatan_grafik', compact('totalPemasukan'));
    }

    public function cetakLaporan()
    {
        if (!Auth::check() || Auth::user()->role !== 'pemilik') {
            abort(403);
        }

        // REVISI KUAT: Melakukan join antara tipe_kamar dengan kolom no_kamar di tabel users
        $kamars = DB::table('kamars')
            ->leftJoin('users', function($join) {
                $join->on('users.role', '=', DB::raw("'penghuni'"))
                     ->whereRaw('users.no_kamar LIKE CONCAT(kamars.tipe_kamar, "%")');
            })
            ->select('kamars.*', 'users.name as nama_penghuni')
            ->get();

        $penghunis = User::where('role', 'penghuni')->get();
        $totalPemasukan = Kamar::where('status', 'Terisi')->sum('harga');

        return view('pemilik.laporan_cetak', compact('kamars', 'penghunis', 'totalPemasukan'));
    }

    public function batalkanSewa(int $id)
    {
        $user = User::findOrFail($id);
        $noKamar = $user->no_kamar; // Ini harusnya berisi "Deluxe"

        // 1. UPDATE KAMAR: Cari yang tipe_kamar nya sama dengan yang dipesan user
        if ($noKamar) {
            $updateKamar = \App\Models\Kamar::where('tipe_kamar', $noKamar)
                                            ->update(['status' => 'Tersedia']);
            
            // Logika untuk memastikan kalau ternyata gagal update
            if (!$updateKamar) {
                Log::error("Gagal update kamar: " . $noKamar);
            }
        }

        // 2. UPDATE USER: Kembalikan ke calon_penyewa
        $user->update([
            'role' => 'calon_penyewa',
            'no_kamar' => null,
            'status_tagihan' => 'belum_bayar'
        ]);

        return redirect()->back()->with('success', 'Sewa dibatalkan. Kamar statusnya sudah diubah ke Tersedia.');
    }

    

    public function dashboardCalonPenyewa()
    {
        $user = Auth::user();
        return view('roles.calon-penyewa-dashboard', compact('user'));
    }

    public function katalogKamar()
    {
        $kamars = Kamar::where('status', 'Tersedia')->get();
        return view('roles.katalog', compact('kamars'));
    }

    public function detailKamar(int $id) 
    {
        $kamar = Kamar::findOrFail($id);
        return view('roles.detail-kamar', compact('kamar'));
    }

    // Tambahkan di dalam KosController
    public function listPembayaran()
    {
        if (!Auth::check() || Auth::user()->role !== 'pemilik') {
            abort(403);
        }

        // Mengambil data pembayaran beserta data user-nya
        $pembayarans = \App\Models\Pembayaran::with('user')->orderBy('created_at', 'desc')->get();

        return view('pemilik.pembayaran_index', compact('pembayarans'));
    }

    public function konfirmasiPembayaran(int $id)
    {
        $pembayaran = \App\Models\Pembayaran::findOrFail($id);

        // 1. Update status pembayaran jadi lunas
        $pembayaran->update(['status' => 'lunas']);

        // 2. SINKRONISASI PENTING: Update status_tagihan di tabel users
        \App\Models\User::where('id', $pembayaran->user_id)->update([
            'status_tagihan' => 'lunas'
        ]);

        return redirect()->back()->with('success', 'Pembayaran berhasil dikonfirmasi!');
    }
}
