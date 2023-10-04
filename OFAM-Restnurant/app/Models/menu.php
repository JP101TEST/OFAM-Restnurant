<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_id',
        'menu_name',
        'menu_image',
        'menu_status',
        'menu_category_id'
    ];
}
