<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    //
    protected $fillable = [
        'image',
    ];

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => url('/storage/sliders/' . $value),
        );
    }
}
