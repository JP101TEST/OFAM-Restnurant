<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class restaurantInfo extends Model
{
    use HasFactory;
    protected $fillable = [
        'restaurant_name',
        'restaurant_logo',
        'restaurant_phone'
    ];
}
