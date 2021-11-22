<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Location;

class Product extends Model
{
    use HasFactory;

    protected $fillable=[
        'id',
        'name',
        'reference',
        'description',
        'type',
        'category',
        'manufacturer',
        'brand',
        'model',
        'sn',
        'tag',
        'property_id',
        'size_id',
        'color_id',
        'um',
        'status',
        'obs',
        'ocs_hw_id',
        'ocs_mon_id',
        'people_id',
        'location_id',
        'create_at',
        'updated_at'
    ];

    public function location() {
        return $this->hasOne(Location::class, "id", "location_id");
    }
}
