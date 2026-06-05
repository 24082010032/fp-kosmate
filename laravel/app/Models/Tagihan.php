<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory;

    protected $table = 'tagihans';

    protected $fillable = ['user_id', 'total_tagihan', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
