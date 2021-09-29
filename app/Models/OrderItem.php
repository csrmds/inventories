<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable=[
        'order_id',
        'product_id',
        'description',
        'order',
        'amount',
        'value',
        'discount',
        'category',
        'created_at',
        'updated_at'
    ];
}
