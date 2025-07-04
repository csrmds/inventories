<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\LdapUser;
use App\Models\User;

class People extends Model
{
    use HasFactory;

    protected $fillable=[
        "id",
        "first_name",
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

    public function getLdapUserLogin() {
        return $this->hasOne(LdapUser::class, "people_id", "id");
    }

    public function getUser() {
        return $this->hasOne(User::class, "people_id", "id");
    }

}
