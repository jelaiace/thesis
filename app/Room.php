<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
      'name',
      'type',
      'department_id'
    ];

    public function department() {
      return $this->belongsTo('App\Department');
    }

    public function schedules() {
      return $this->hasMany('App\Schedule');
    }
}
