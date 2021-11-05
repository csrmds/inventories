<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OcsAccountInfo extends Model
{
    use HasFactory;

    protected $fillable=[
        'hardware_id',
        'tag'
    ];
}
