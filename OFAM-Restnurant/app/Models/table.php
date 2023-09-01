<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class table extends Model
{
    use HasFactory;

    //protected $primaryKey = 'table_id';
    protected $fillable = [
        'table_id',
        'status_tables'
    ];
    public $incrementing = false;
}
