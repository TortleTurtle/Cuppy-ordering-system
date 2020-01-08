<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    //table name
    protected $table = 'points';
    //primary key
    public $primaryKey = 'id';
    //Timestamps
    public $timestamps = false;

    protected $fillable = [
        'points','created_at','user_id'
    ];
    //relationships
    public function owner(){
        return $this->belongsTo('App\User', 'user_id');
    }
}
