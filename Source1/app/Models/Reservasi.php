<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservasi extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'nama_tamu', 'email', 'no_hp', 'tanggal_checkin',
        'tanggal_checkout', 'tipe_kamar', 'created_at', 'updated_at'
    ];
}
