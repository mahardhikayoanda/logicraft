<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservasiDihapus extends Model
{
    protected $fillable = [
        'nama_tamu',
        'email',
        'no_hp',
        'tanggal_checkin',
        'tanggal_checkout',
        'tipe_kamar',
    ];
}
