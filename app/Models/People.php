<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    use HasFactory;

    protected $fillable=[
        "id",
        "firs_name",
        "last_name",
        "nick_name",
        "type",
        "category",
        "birth_date",
        "zipcode",
        "country",
        "state",
        "city",
        "district",
        "address",
        "number",
        "complement",
        "rg",
        "cpf",
        "cnpj",
        "ie",
        "sistema",
        "created_at",
        "updated_at"
    ];
    
}
