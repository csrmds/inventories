<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable=[
        'id',
        'people_origin',
        'people_destiny',
        'title',
        'category',
        'description',
        'location_origin',
        'location_destiny',
        'user_id',
        'request_from',
        'value',
        'discount',
        'status',
        'created_at',
        'updated_at'
    ];
}
