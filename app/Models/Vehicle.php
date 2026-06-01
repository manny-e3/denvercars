<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'key',
        'name',
        'class',
        'description',
        'passengers',
        'luggage',
        'hourly_rate',
        'airport_rate',
        'image',
        'status',
    ];
}
