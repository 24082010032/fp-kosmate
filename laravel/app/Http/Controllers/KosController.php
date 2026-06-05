<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kamar;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class KosController extends Controller
{
    public function welcome()
    {
        if (auth()->check()) {
            return redirect()->route(auth()->user()->role . '.dashboard');
        }

        return view('auth.landing');
    }

    public function calonPenyewa()
    {
        if (!auth()->check()) {
            return Redirect::route('login')->with('error', 'Silakan login atau daftar untuk melihat kamar.');
        }

        if (auth()->user()->role !== 'calon_penyewa') {
            abort(403);
        }

        $kamars = Kamar::where('status', 'Tersedia')->get();
        return view('roles.calon-penyewa', compact('kamars'));
    }

    public function penghuni()
    {
        return view('roles.penghuni');
    }

    public function pemilik()
    {
        return view('roles.pemilik');
    }

    // Fungsi menampilkan calon penyewa di dashboard pemilik
    public function listCalonPenyewa()
    {
        if (auth()->user()->role !== 'pemilik') {
            abort(403);
        }

        // Ambil data user yang role-nya calon_penyewa langsung dari DB
        $calonPenyewa = DB::table('users')
                            ->where('role', 'calon_penyewa')
                            ->get();

        return view('pemilik.calon_penyewa', compact('calonPenyewa'));
    }

    // 🟢 FIX: Sudah diganti menjadi public function index() biar VS Code adem gak merah lagi
    public function index()
    {
        $kamar = [
            ['id' => 1, 'name' => 'Sweet Blossom', 'price' => 'Rp 1.200.000', 'status' => 'Tersedia', 'description' => 'Kamar pink cozy lengkap AC & WiFi.'],
            ['id' => 2, 'name' => 'Matcha Cozy', 'price' => 'Rp 1.350.000', 'status' => 'Terisi', 'description' => 'Sentuhan hijau calm dengan balkon mini.'],
            ['id' => 3, 'name' => 'Cream Cloud', 'price' => 'Rp 1.150.000', 'status' => 'Tersedia', 'description' => 'Nuansa cream dengan laundry friendly.'],
        ];

        return view('pemilik.kamar.index', compact('kamar'));
    }

    public function create()
    {
        return view('pemilik.kamar.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|string|max:255',
            'status' => 'required|in:Tersedia,Terisi',
            'description' => 'nullable|string|max:500',
        ]);

        return redirect()->route('pemilik.kamar.index')->with('message', 'Kamar berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kamar = [
            'id' => $id,
            'name' => 'Sweet Blossom',
            'price' => 'Rp 1.200.000',
            'status' => 'Tersedia',
            'description' => 'Kamar pink cozy lengkap AC & WiFi.',
        ];

        return view('pemilik.kamar.edit', compact('kamar'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|string|max:255',
            'status' => 'required|in:Tersedia,Terisi',
            'description' => 'nullable|string|max:500',
        ]);

        return redirect()->route('pemilik.kamar.index')->with('message', 'Kamar berhasil diupdate.');
    }

    public function destroy($id)
    {
        return redirect()->route('pemilik.kamar.index')->with('message', 'Kamar berhasil dihapus.');
    }
}