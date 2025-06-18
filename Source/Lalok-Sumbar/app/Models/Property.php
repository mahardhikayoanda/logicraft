<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    // Definisi konstanta yang dibutuhkan
    const TYPES = [
        'house' => 'Rumah',
        'apartment' => 'Apartemen',
        'villa' => 'Villa',
        'townhouse' => 'Townhouse',
        'condo' => 'Kondominium',
        'land' => 'Tanah',
        'commercial' => 'Komersial',
        'office' => 'Kantor',
        'warehouse' => 'Gudang',
        'shop' => 'Toko'
    ];

    const STATUSES = [
        'active' => 'Aktif',
        'inactive' => 'Tidak Aktif',
        'rented' => 'Tersewa',
        'sold' => 'Terjual',
        'maintenance' => 'Maintenance'
    ];

    const RENTAL_STATUSES = [
        'available' => 'Tersedia',
        'rented' => 'Tersewa',
        'sold' => 'Terjual',
        'not_available' => 'Tidak Tersedia'
    ];

    protected $fillable = [
        'name',
        'type',
        'description',
        'address',
        'city',
        'state',
        'postal_code',
        'bedrooms',
        'bathrooms',
        'area',
        'year_built',
        'status',
        'rental_status',
        'monthly_rent',
        'estimated_value',
        'price', 
        'owner_id'
    ];

    protected $attributes = [
        'status' => 'active',
        'rental_status' => 'available',
        'price' => 0, // Default value untuk price
    ];

    protected $casts = [
        'bedrooms' => 'integer',
        'bathrooms' => 'integer',
        'area' => 'decimal:2',
        'price' => 'decimal:2',
        'year_built' => 'integer',
        'monthly_rent' => 'decimal:2',
        'estimated_value' => 'decimal:2',
    ];

    // Relasi dengan User (pemilik property) - UPDATED
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    // Alias untuk backward compatibility jika ada kode lain yang masih pakai user()
    public function user()
    {
        return $this->owner();
    }

    // Relasi dengan PropertyImages jika ada
    public function images()
    {
        return $this->hasMany(PropertyImage::class);
    }

        /**
     * Mendapatkan gambar utama property
     */
    public function primaryImage()
    {
        return $this->hasOne(PropertyImage::class)->where('is_primary', true);
    }

    /**
     * Mendapatkan semua gambar kecuali yang primary
     */
    public function secondaryImages()
    {
        return $this->hasMany(PropertyImage::class)->where('is_primary', false);
    }

    // Helper methods untuk mendapatkan label
    public function getTypeLabel()
    {
        return self::TYPES[$this->type] ?? $this->type;
    }

    public function getStatusLabel()
    {
        return self::STATUSES[$this->status] ?? $this->status;
    }

    public function getRentalStatusLabel()
    {
        return self::RENTAL_STATUSES[$this->rental_status] ?? $this->rental_status;
    }
}