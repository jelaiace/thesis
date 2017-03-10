<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'name'
    ];

    public function subjects() {
        return $this->hasMany('App\Subject');
    }

    public function users() {
        return $this->hasMany('App\User');
    }
}
