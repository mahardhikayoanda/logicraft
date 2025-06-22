<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'property_id',
        'check_in_date',
        'check_out_date',
        'total_price',
        'status',
        'nama_lengkap',
        'email',
        'no_hp',
        'jumlah_tamu',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }
}