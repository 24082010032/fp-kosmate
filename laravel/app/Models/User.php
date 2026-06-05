<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Kolom yang boleh diisi massal.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'no_hp',
        'no_kamar',
    ];

    /**
     * Kolom yang disembunyikan (Cukup SATU kali ditulis di sini, Din).
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casting tipe data.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed', // Biar Laravel otomatis tahu kalau password-nya di-hash
    ];
}