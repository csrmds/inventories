<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable=[
        'id',
        'people_id',
        'description',
        'product_id',
        'product_qtd',
        'created_at',
        'updated_at'
    ];
}
