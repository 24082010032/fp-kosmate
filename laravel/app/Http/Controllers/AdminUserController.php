<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function pemilik()
    {
        $users = User::where('role', 'pemilik')->get();
        return view('pemilik.users_pemilik', compact('users'));
    }

    public function penghuni()
    {
        $users = User::where('role', 'penghuni')->get();
        return view('pemilik.users_penghuni', compact('users'));
    }

    public function calonPenyewa()
    {
        $users = User::where('role', 'calon_penyewa')->get();
        return view('pemilik.users_calon_penyewa', compact('users'));
    }
}
