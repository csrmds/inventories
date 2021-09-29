<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable=[
        'id',
        'name',
        'reference',
        'description',
        'type',
        'category',
        'manufacturer',
        'brand',
        'model',
        'sn',
        'tag',
        'property_id',
        'size_id',
        'color_id',
        'um',
        'status',
        'obs',
        'create_at',
        'updated_at'
    ];
}
