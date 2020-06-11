<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $guarded = [

    ];

    public $casts = ['payment'=>'boolean'];

    public function toilet(){
        return $this->belongsTo(Toilet::class);
    }
}
