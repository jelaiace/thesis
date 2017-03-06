<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'name',
        'type'
    ];

    public function schedules() {
        return $this->hasMany('App\Schedule');
    }
}
