<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bill_list extends Model
{
    use HasFactory;

    protected $fillable = [
        'bill_id',
        'employees_id',
        'food_order_id',
        'promotion_id',
        'discount_thad_day',
        'total_price',
        'customer_name',
        'time_payment',
        'restaurant_id'
    ];
}
