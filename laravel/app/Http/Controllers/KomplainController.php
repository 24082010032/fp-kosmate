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
        $data = $request->validate(['isi_komplain' => 'required|string']);
        Komplain::create(['user_id' => auth()->id(), 'isi_komplain' => $data['isi_komplain']]);
        return back()->with('message','Komplain dikirim');
    }
}
