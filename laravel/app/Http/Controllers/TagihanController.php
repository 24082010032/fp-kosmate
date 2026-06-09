<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use App\Models\Kamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TagihanController extends Controller
{
    // 1. Index Tagihan
    public function index()
    {
        if (Auth::user()->role === 'pemilik') {
            $tagihans = Tagihan::with('user')->orderBy('created_at','desc')->get();
        } else {
            $tagihans = Tagihan::where('user_id', Auth::id())->get();
        }
        return view('tagihans.index', compact('tagihans'));
    }

    // 2. Store Tagihan
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

    // 3. Konfirmasi Pembayaran (Prinsip ACID - Aman untuk data keuangan)
    public function konfirmasiPembayaran(Request $request, int $id)
    {
        $request->validate([
            'kamar_id' => 'required|exists:kamars,id',
        ]);

        DB::beginTransaction();
        try {
            // Update status tagihan
            $tagihan = Tagihan::findOrFail($id);
            $tagihan->update(['status' => 'lunas']);

            // Update status kamar
            $kamar = Kamar::findOrFail($request->kamar_id);
            $kamar->update(['status' => 'terisi']);

            DB::commit();
            return back()->with('message', 'Pembayaran berhasil dikonfirmasi dan kamar telah diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal memproses konfirmasi: ' . $e->getMessage());
        }
    }

    // 4. Upload Pembayaran (Fitur dari Dinda)
    public function uploadPembayaran(Request $request)
    {
        $request->validate([
            'jumlah_bayar' => 'required|numeric',
            'nomor_kamar' => 'required'
        ]);

        DB::table('pembayarans')->insert([
            'user_id' => Auth::id(),
            'jumlah_bayar' => $request->jumlah_bayar,
            'nomor_kamar' => $request->nomor_kamar,
            'bukti_transfer' => 'Tanpa Gambar',
            'status' => 'pending', 
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Konfirmasi nominal pembayaran berhasil dikirim!');
    }

    // 5. Cetak Kuitansi (Fitur dari Dinda)
    public function cetakKuitansi(int $id)
    {
        // Placeholder: Tambahkan logic PDF nantinya
        return "Halaman Cetak Kuitansi ID: " . $id . " (Fitur export PDF sedang disiapkan)";
    }
}