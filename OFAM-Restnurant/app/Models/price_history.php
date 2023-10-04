<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class price_history extends Model
{
    use HasFactory;
    protected $fillable = [
        'price_history_id',
        'price',
        'menu_id',
        'date_start',
        'date_end'
    ];
}
