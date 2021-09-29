<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable=[
        'people_id',
        'product_id',
        'entry',
        'out',
        'value'
    ];
}
