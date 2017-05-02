<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name'
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function schedules() {
        return $this->hasManyThrough('App\Schedule', 'App\Room');
    }

    public function subjects() {
        return $this->hasMany('App\Subject');
    }

    public function users() {
        return $this->hasMany('App\User');
    }

    public function blocks() {
        return $this->hasManyThrough('App\Block', 'App\Course');
    }

    public function rooms() {
        return $this->hasMany('App\Room');
    }

    public function courses() {
        return $this->hasMany('App\Course');
    }
}
