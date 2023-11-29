<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class food_order extends Model
{
    use HasFactory;

    protected $fillable = [
        'food_order_id',
        'table_id',
        'menu_id',
        'food_amount',
        'food_order_status',
        'date_order'
    ];

}
