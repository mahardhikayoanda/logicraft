<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Property extends Model
{
    //
    use HasFactory;

    protected $fillable = ['owner_id', 'name', 'location', 'price_per_night', 'description', 'facilities'];

    protected $casts = [
        'is_available' => 'boolean',
    ];


    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function images()
    {
        return $this->hasMany(PropertyImage::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }
}
