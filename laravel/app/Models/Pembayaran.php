<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    // Menentukan nama tabel agar Laravel tahu ini merujuk ke tabel pembayarans
    protected $table = 'pembayarans';

    // Kolom-kolom yang boleh diisi
    protected $fillable = [
        'user_id', 
        'nomor_kamar', 
        'jumlah_bayar', 
        'bukti_transfer', 
        'status'
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}