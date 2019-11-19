<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'clip', 'engrave', 'front_img', 'back_img', 'location'
    ];

    //relationships
    public function owner(){
        return $this->belongsTo('App\User', 'owner');
    }
}