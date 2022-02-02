<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OcsServer extends Model
{
    use HasFactory;

    protected $fillable=[
        'id',
        'alias',
        'host',
        'database_name',
        'database_user',
        'database_password',
        'database_port',
        'status'
    ];
}
