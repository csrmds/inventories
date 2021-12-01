<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class LdapUser extends Authenticatable
{
    use HasFactory;

    protected $fillable= [
        'name', 'email', 'password', 'people_id', 'guid', 'domain'
    ];

    protected $hidden= [
        'password', 'remember_token'
    ];

    public function getPeople()
    {
        
    }
}
