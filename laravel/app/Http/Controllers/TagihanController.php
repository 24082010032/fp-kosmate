<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use Illuminate\Http\Request;

class TagihanController extends Controller
{
    public function index()
    {
        if (auth()->user()->role === 'pemilik') {
            $tagihans = Tagihan::with('user')->orderBy('created_at','desc')->get();
        } else {
            $tagihans = Tagihan::where('user_id', auth()->id())->get();
        }
        return view('tagihans.index', compact('tagihans'));
    }

    public function store(Request $request)
    {
        $data = $request->validate(['user_id' => 'required|exists:users,id','total_tagihan' => 'required|numeric']);
        Tagihan::create(['user_id' => $data['user_id'], 'total_tagihan' => $data['total_tagihan']]);
        return back()->with('message','Tagihan dibuat');
    }

    // ==========================================
    // TAMBAHAN FITUR: VERIFIKASI TANPA GAMBAR + FIX NOMOR KAMAR
    // ==========================================
    public function uploadPembayaran(Request $request)
    {
        // Masukin data ke tabel pembayarans, termasuk nomor_kamar bawaan form
        \Illuminate\Support\Facades\DB::table('pembayarans')->insert([
            'user_id' => auth()->id(),
            'jumlah_bayar' => $request->jumlah_bayar,
            'nomor_kamar' => $request->nomor_kamar, // <--- Ini dia kuncinya biar gak eror lagi!
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
}