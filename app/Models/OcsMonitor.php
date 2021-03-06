<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OcsMonitor extends Model
{
    use HasFactory;

    protected $fillable=[
        'id',
        'hardware_id',
        'manufacturer',
        'caption',
        'description',
        'type',
        'serial'
    ];
}
