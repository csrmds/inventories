<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $fillable=[
        'id',
        'user_id',
        'event',
        'msg01',
        'msg02',
        'msg03',
        'level',
        'created_at',
        'updated_at'
    ];
}
