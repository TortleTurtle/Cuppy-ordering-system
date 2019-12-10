<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cup extends Model
{
    //table name
    protected $table = 'cups';
    //primary key
    public $primaryKey = 'id';
    //Timestamps
    public $timestamps = false;

    protected $fillable = [
        'coffee_ordered','user_id','created_at'
    ];
    //relationships
    public function owner(){
        return $this->belongsTo('App\User', 'user_id');
    }
}
