<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class promotion extends Model
{
    use HasFactory;
    protected $fillable = [
        'promotion_id',
        'promotion_code',
        'promotion_name',
        'discount',
        'date_start',
        'date_end'
    ];
}
