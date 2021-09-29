<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    use HasFactory;

    protected $fillable=[
        'id',
        'product_id',
        'order_id',
        'order_item_id',
        'amount',
        'movement',
        'order_reference_id',
        'created_at',
        'updated_at'
    ];
}
