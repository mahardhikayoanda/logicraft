<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    //
    protected $fillable = [
        'title',
        'start_date',
        'end_date',
        'description',
        'image_path',
    ];
}
