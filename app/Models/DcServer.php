<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DcServer extends Model
{
    use HasFactory;

    protected $fillable=[
        "id",
        "alias",
        "host",
        "domain_name",
        "user",
        "password",
        "port",
        "status"
    ];
}
