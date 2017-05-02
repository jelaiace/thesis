<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use SoftDeletes;

    protected $fillable = [
      'name',
      'type',
      'department_id'
    ];

    protected $dates = [
      'deleted_at'
    ];

    public function department() {
      return $this->belongsTo('App\Department')->withTrashed();
    }

    public function schedules() {
      return $this->hasMany('App\Schedule');
    }
}
