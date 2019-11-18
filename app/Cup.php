<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cup extends Model
{
    //relationships
    public function owner(){
        return $this->belongsTo('App\User', 'owner');
    }
}
