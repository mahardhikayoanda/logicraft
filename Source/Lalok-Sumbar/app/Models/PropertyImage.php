<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'image_path',
        'alt_text',
        'is_primary'
    ];

    protected $casts = [
        'is_primary' => 'boolean',
    ];

    /**
     * Relationship dengan Property
     */
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    /**
     * Accessor untuk mendapatkan URL gambar lengkap
     */
    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->image_path);
    }
}