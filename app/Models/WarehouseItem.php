<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'quantity',
        'price',
        'date_added'
    ];

    // If you want to use 'date_added' with Laravel's date casting
    protected $casts = [
        'date_added' => 'datetime',
    ];
}