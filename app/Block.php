<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    protected $fillable = [
        'name',
        'course_id',
        'year_level',
        'semester'
    ];

    public function course() {
        return $this->belongsTo('App\Course');
    }

    public function schedules() {
        return $this->hasMany('App\Schedule');
    }
}
