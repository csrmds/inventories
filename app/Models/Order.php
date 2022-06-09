<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Location;
use App\Models\People;

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

    public function getLocationOrigin() {
        return $this->hasOne(Location::class, "id", "location_origin");
    }

    public function getLocationDestiny() {
        return $this->hasOne(Location::class, "id", "location_destiny");
    }

    public function getPeopleOrigin() {
        return $this->hasOne(People::class, "id", "people_origin");
    }

    public function getPeopleDestiny() {
        return $this->hasOne(People::class, "id", "people_destiny");
    }

    public function getUser() {
        return $this->hasOne(User::class, "id", "user_id");
    }
}
