<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kamar;
use App\Models\User; 
use App\Models\Komplain; 
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;

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

        $kamarTersedia = Kamar::where('status', 'Tersedia')->count();
        $penghuniAktif = User::where('role', 'penghuni')->count();
        $komplainBaru = Komplain::count();

        return view('roles.pemilik', compact('kamarTersedia', 'penghuniAktif', 'komplainBaru'));
    }

    public function listCalonPenyewa()
    {
        if (!Auth::check() || Auth::user()->role !== 'pemilik') {
            abort(403);
        }

        $users = User::where('role', 'calon_penyewa')->get();

        return view('roles.calon-penyewa', compact('users'));
    }

    // ==========================================
    // BAGIAN CRUD KAMAR (REVISI: MENGGUNAKAN DATABASE)
    // ==========================================
    public function index()
    {
        if (!Auth::check() || Auth::user()->role !== 'pemilik') {
            abort(403);
        }

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

        $kamar = Kamar::findOrFail($id);
        return view('pemilik.kamar.edit', compact('kamar'));
    }

    public function update(Request $request, int $id) 
    {
        if (!Auth::check() || Auth::user()->role !== 'pemilik') {
            abort(403);
        }

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

    // ==========================================
    // KELOLA AKSI PENGGUNA & TAGIHAN
    // ==========================================
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

    public function konfirmasiLunas($id)
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

    public function komplainSelesai($id)
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
    // 🛠️ MONITORING VISUAL KAMAR (SINKRON DATA ASLI)
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
    // 📊 REVISI AKURASI DATA: GRAPHIC FEATURE & PRINT REPORT
    // ==========================================
    public function grafikPendapatan()
    {
        if (!Auth::check() || Auth::user()->role !== 'pemilik') {
            abort(403);
        }

        $totalPemasukan = Kamar::where('status', 'Terisi')->sum('harga');
        return view('pemilik.pendapatan_grafik', compact('totalPemasukan'));
    }

    public function cetakLaporan()
    {
        if (!Auth::check() || Auth::user()->role !== 'pemilik') {
            abort(403);
        }

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

    public function batalkanSewa($id)
    {
        $user = User::findOrFail($id);
        $noKamar = $user->no_kamar; 

        if ($noKamar) {
            $updateKamar = Kamar::where('tipe_kamar', $noKamar)
                                ->update(['status' => 'Tersedia']);
            
            if (!$updateKamar) {
                Log::error("Gagal update kamar: " . $noKamar);
            }
        }

        $user->update([
            'role' => 'calon_penyewa',
            'no_kamar' => null,
            'status_tagihan' => 'belum_bayar'
        ]);

        return redirect()->back()->with('success', 'Sewa dibatalkan. Kamar statusnya sudah diubah ke Tersedia.');
    }

    // 🟢 GABUNGAN AMAN: FITUR PROSES BOOKING MULTI-STRUKTUR & ACID TRANSACTION
    public function prosesBooking(Request $request, $id)
    {
        return DB::transaction(function () use ($id) {
            $kamar = Kamar::where('id', $id)->lockForUpdate()->firstOrFail();

            if ($kamar->status !== 'Tersedia') {
                return redirect()->back()->with('error', 'Maaf, kamar sudah tidak tersedia.');
            }

            // Update status kamar jadi dipesan/proses
            $kamar->update(['status' => 'Terisi']); 

            // Update user: Set no_kamar dan tandai sedang mengajukan sewa
            auth()->user()->update([
                'no_kamar' => $kamar->tipe_kamar, 
                'status_tagihan' => 'menunggu_konfirmasi'
            ]);

            // Deteksi otomatis nama kolom relasi kamar pada tabel tagihans (Fitur Cerdas Dinda)
            $kolomKamar = 'kamar_id';
            if (Schema::hasColumn('tagihans', 'id_kamar')) {
                $kolomKamar = 'id_kamar';
            } elseif (Schema::hasColumn('tagihans', 'kos_id')) {
                $kolomKamar = 'kos_id';
            }

            // Masukkan transaksi awal ke tabel tagihans
            DB::table('tagihans')->insert([
                'user_id' => auth()->user()->id,
                $kolomKamar => $id,
                'status' => 'Pending',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect()->route('calon-penyewa.dashboard')->with('success', 'Booking berhasil! Menunggu konfirmasi pemilik.');
        });
    }

    public function dashboardCalonPenyewa()
    {
        $user = auth()->user();
        return view('roles.calon-penyewa-dashboard', compact('user'));
    }

    public function katalogKamar()
    {
        $kamars = Kamar::where('status', 'Tersedia')->get();
        return view('roles.katalog', compact('kamars'));
    }

    public function detailKamar($id) 
    {
        $kamar = Kamar::findOrFail($id);
        return view('roles.detail-kamar', compact('kamar'));
    }
}