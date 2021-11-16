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
        'name',
        'description',
        'created_at',
        'updated_at'
    ];
}
