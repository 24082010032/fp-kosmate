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
}
