<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //relationships
    public function owner(){
        return $this->belongsTo('App\User', 'owner');
    }
}