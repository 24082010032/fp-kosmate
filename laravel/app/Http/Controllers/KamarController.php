<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use Illuminate\Http\Request;

class KamarController extends Controller
{
    public function index()
    {
        $kamar = Kamar::orderBy('created_at', 'desc')->get();
        return view('pemilik.kamar.index', compact('kamar'));
    }

    public function create()
    {
        return view('pemilik.kamar.create');
    }

    public function store(Request $request)
    {
        // Validasi disesuaikan dengan atribut name="tipe_kamar" dari form
        $data = $request->validate([
            'tipe_kamar' => 'required|string|max:255',
            'harga'      => 'required|string|max:255',
            'status'     => 'required|in:Tersedia,Terisi',
            'description'=> 'nullable|string',
        ]);

        Kamar::create([
            'tipe_kamar' => $data['tipe_kamar'],
            'harga'      => $data['harga'],
            'status'     => $data['status'],
            'fasilitas'  => $data['description'] ?? null,
        ]);

        return redirect()->route('pemilik.kamar.index')->with('message', 'Kamar berhasil ditambahkan.');
    }

    public function edit(Kamar $kamar)
    {
        return view('pemilik.kamar.edit', ['kamar' => $kamar]);
    }

    public function update(Request $request, Kamar $kamar)
    {
        // Validasi saat update juga disesuaikan ke properti tipe_kamar
        $data = $request->validate([
            'tipe_kamar' => 'required|string|max:255',
            'harga'      => 'required|string|max:255',
            'status'     => 'required|in:Tersedia,Terisi',
            'description'=> 'nullable|string',
        ]);

        $kamar->update([
            'tipe_kamar' => $data['tipe_kamar'],
            'harga'      => $data['harga'],
            'status'     => $data['status'],
            'fasilitas'  => $data['description'] ?? null,
        ]);

        return redirect()->route('pemilik.kamar.index')->with('message', 'Kamar berhasil diupdate.');
    }

    public function destroy(Kamar $kamar)
    {
        $kamar->delete();
        return redirect()->route('pemilik.kamar.index')->with('message', 'Kamar berhasil dihapus.');
    }
}