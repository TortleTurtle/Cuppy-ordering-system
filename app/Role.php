<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    public $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

    //relationships
    public function users(){
        return $this->hasMany('App\User');
    }
    public function permissions(){
        return $this->belongsToMany('App\Permission');
    }
}