<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'penginapan_id',
        'rating',
        'komentar',
    ];

    // Relasi ke user yang memberikan ulasan
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke penginapan yang diulas
    public function penginapan()
    {
        return $this->belongsTo(Penginapan::class);
    }
    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class);
    }
}