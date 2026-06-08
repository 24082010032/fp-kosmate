<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use App\Models\Kamar; // Pastikan Model Kamar di-import jika ada update kamar
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // WAJIB di-import untuk transaction

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

    // 3. FUNGSI BARU (Penerapan Prinsip ACID untuk modul tugasmu)
    // Digunakan saat pemilik mengonfirmasi bahwa tagihan sudah dibayar
    public function konfirmasiPembayaran(Request $request, $id)
    {
        $request->validate([
            'kamar_id' => 'required|exists:kamars,id',
        ]);

        // ATOMICITY dimula dari sini
        DB::beginTransaction();

        try {
            // Aksi 1: Update status tagihan jadi lunas
            $tagihan = Tagihan::findOrFail($id);
            $tagihan->update([
                'status' => 'lunas' // Memastikan data konsisten (Consistency)
            ]);

            // Aksi 2: Update status kamar terkait menjadi 'terisi' atau perpanjang tanggal
            $kamar = Kamar::findOrFail($request->kamar_id);
            $kamar->update([
                'status' => 'terisi' 
            ]);

            // Jika Aksi 1 dan Aksi 2 sukses tanpa error, kunci data secara permanen (Durability)
            DB::commit();

            return back()->with('message', 'Pembayaran tagihan berhasil dikonfirmasi dan kamar telah diperbarui.');

        } catch (\Exception $e) {
            // Jika salah satu aksi gagal (misal tabel kamar error), batalkan semua! (Atomicity)
            DB::rollBack();

            return back()->with('error', 'Gagal memproses konfirmasi: ' . $e->getMessage());
        }
    }
}