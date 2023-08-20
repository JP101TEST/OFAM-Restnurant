<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employee extends Model
{
    use HasFactory;

    protected $primaryKey = 'employees_id'; // Set the primary key field name

    protected $fillable = [
        'employees_id',
        'employees_password',
        'first_name',
        'last_name',
        'house_number',
        'road',
        'sub_district',
        'district',
        'province',
        'postal_code',
        'employees_picture',
        'employees_phone',
        'management_lavel',
    ];

    // Optionally, you can set the default values for some fields
    protected $attributes = [
        'management_lavel' => 'employee', // Default value for management_lavel column
    ];

    protected $casts = [
        'postal_code' => 'integer',
        'employees_phone' => 'integer',
    ];
}
