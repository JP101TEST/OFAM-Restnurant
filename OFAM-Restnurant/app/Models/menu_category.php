<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class menu_category extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_category_id',
        'menu_category_name'
    ];
}
