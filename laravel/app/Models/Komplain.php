<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komplain extends Model
{
    use HasFactory;

    protected $table = 'komplains';

    protected $fillable = ['user_id', 'isi_komplain', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
