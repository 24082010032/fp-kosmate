<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use App\Models\Kamar; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 

class TagihanController extends Controller
{
    // 1. CODE LAMAMU (Tetap dipertahankan)
    public function index()
    {
        if (auth()->user()->role === 'pemilik') {
            $tagihans = Tagihan::with('user')->orderBy('created_at','desc')->get();
        } else {
            $tagihans = Tagihan::where('user_id', auth()->id())->get();
        }
        return view('tagihans.index', compact('tagihans'));
    }

    // 2. CODE LAMAMU (Tetap dipertahankan)
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'total_tagihan' => 'required|numeric'
        ]);
        
        Tagihan::create([
            'user_id' => $data['user_id'], 
            'total_tagihan' => $data['total_tagihan']
        ]);
        
        return back()->with('message','Tagihan dibuat');
    }

    // ==========================================
    // TAMBAHAN FITUR: VERIFIKASI TANPA GAMBAR + FIX NOMOR KAMAR (Fitur Dinda)
    // ==========================================
    public function uploadPembayaran(Request $request)
    {
        // Masukin data ke tabel pembayarans, termasuk nomor_kamar bawaan form
        DB::table('pembayarans')->insert([
            'user_id' => auth()->id(),
            'jumlah_bayar' => $request->jumlah_bayar,
            'nomor_kamar' => $request->nomor_kamar, 
            'bukti_transfer' => 'Tanpa Gambar',
            'status' => 'pending', 
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Konfirmasi nominal pembayaran berhasil dikirim! Menunggu check dari pemilik.');
    }

    public function cetakKuitansi($id)
    {
        return "Halaman Cetak Kuitansi ID: " . $id . " (Fitur export PDF sedang disiapkan)";
    }

    // ==========================================
    // FUNGSI BARU: Penerapan Prinsip ACID (Fitur Dhea)
    // ==========================================
    public function konfirmasiPembayaran(Request $request, $id)
    {
        $request->validate([
            'kamar_id' => 'required|exists:kamars,id',
        ]);

        // ATOMICITY dimulai dari sini
        DB::beginTransaction();

        try {
            // Aksi 1: Update status tagihan jadi lunas
            $tagihan = Tagihan::findOrFail($id);
            $tagihan->update([
                'status' => 'lunas' 
            ]);

            // Aksi 2: Update status kamar terkait menjadi 'terisi'
            $kamar = Kamar::findOrFail($request->kamar_id);
            $kamar->update([
                'status' => 'terisi' 
            ]);

            // Jika semua sukses, kunci data secara permanen (Durability)
            DB::commit();

            return back()->with('message', 'Pembayaran tagihan berhasil dikonfirmasi dan kamar telah diperbarui.');

        } catch (\Exception $e) {
            // Jika salah satu aksi gagal, batalkan semua! (Atomicity)
            DB::rollBack();

            return back()->with('error', 'Gagal memproses konfirmasi: ' . $e->getMessage());
        }
    }
}