<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;

    protected $table = 'kamars';

    // 🛠️ REVISI: Menambahkan 'user_id' agar database bisa menyimpan id penghuni di kamar ini
    protected $fillable = [
        'tipe_kamar', 'harga', 'status', 'fasilitas', 'foto', 'user_id'
    ];

    /**
     * Relasi ke data Penghuni (User)
     * Menghubungkan kolom user_id di tabel kamars ke id di tabel users
     */
    public function penghuni()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}