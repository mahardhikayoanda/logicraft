<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyImage extends Model
{
    protected $fillable = ['property_id', 'path', 'filename', 'is_primary', 'alt_text'];
    
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