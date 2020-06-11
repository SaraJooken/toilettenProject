<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Toilet extends Model
{
    public $incrementing = false;

    protected $fillable = [
        'business_product_id', 'name', 'street', 'house_number', 'box_number', 'postal_code', 'city_name', 'main_city_name', 'lat', 'long', 'product_description'
    ];

    public function reviews(){
        return $this->hasMany(Review::class);
    }
}
