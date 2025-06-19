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

    public function isBookedOn($checkIn, $checkOut)
    {
        return $this->reservations()
            ->where(function ($query) use ($checkIn, $checkOut) {
                $query->where('status', '!=', 'canceled')
                    ->where(function ($query) use ($checkIn, $checkOut) {
                        $query->whereBetween('check_in_date', [$checkIn, $checkOut])
                            ->orWhereBetween('check_out_date', [$checkIn, $checkOut])
                            ->orWhere(function ($q) use ($checkIn, $checkOut) {
                                $q->where('check_in_date', '<=', $checkIn)
                                    ->where('check_out_date', '>=', $checkOut);
                            });
                    });
            })->exists();
    }
}
