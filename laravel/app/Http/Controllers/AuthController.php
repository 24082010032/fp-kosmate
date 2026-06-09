<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie; // Ditambahkan untuk urusan cookie

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:pemilik,penghuni,calon_penyewa',
            'no_hp' => 'nullable|string|max:30',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
            'no_hp' => $data['no_hp'] ?? null,
        ]);

        Auth::login($user);

        // ==================================================
        // COOKIE & SESSION SAAT REGISTRASI
        // ==================================================
        session([
            'info_pendaftaran' => 'Akun baru berhasil didaftarkan!',
            'waktu_daftar' => now()->toDateTimeString()
        ]);
        Cookie::queue('email_pendaftar_terakhir', $user->email, 60);
        // ==================================================

        return $this->redirectByRole($user);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            // ==================================================
            // COOKIE & SESSION SAAT LOGIN
            // ==================================================
            session([
                'info_tes_session' => 'Session ini berhasil dibuat dari AuthController!',
                'waktu_masuk' => now()->toDateTimeString()
            ]);
            Cookie::queue('cookie_user_kosmate', $request->email, 60);
            // ==================================================

            return $this->redirectByRole(Auth::user());
        }

        return back()->withErrors(['email' => 'Email atau password salah'])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    protected function redirectByRole(User $user)
    {
        return match ($user->role) {
            'pemilik' => redirect('/pemilik/dashboard'),
            'penghuni' => redirect('/penghuni/dashboard'),
            'calon_penyewa' => redirect('/calon-penyewa/dashboard'),
            default => redirect('/'),
        };
    }
}