<?php

namespace App\Http\Controllers;

use App\Models\Komplain;
use Illuminate\Http\Request;

class KomplainController extends Controller
{
    public function index()
    {
        if (auth()->user()->role === 'pemilik') {
            $komplains = Komplain::with('user')->orderBy('created_at','desc')->get();
        } else {
            $komplains = Komplain::where('user_id', auth()->id())->get();
        }
        return view('komplains.index', compact('komplains'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'isi_komplain' => 'required'
        ]);

        Komplain::create([
            'user_id' => auth()->id(),
            'isi_komplain' => $data['isi_komplain'],
            'status' => 'Pending'
        ]);

        return back()->with('message', 'Komplain dikirim');
    }

    // ==========================================
    // TAMBAHAN FITUR: PROSES KOMPLAIN DARI DASHBOARD
    // ==========================================
    public function kirimKomplain(Request $request)
    {
        // Gabungkan judul dan deskripsi biar masuk ke kolom isi_komplain di database
        $isiLengkap = $request->judul_komplain . ' - ' . $request->deskripsi;

        \Illuminate\Support\Facades\DB::table('komplains')->insert([
            'user_id' => auth()->id(),
            'isi_komplain' => $isiLengkap,
            'status' => 'Pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Laporan keluhan Anda berhasil dikirim ke pemilik kos!');
    }
}