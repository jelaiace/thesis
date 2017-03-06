<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable =[
        'name',
        'start_time',
        'end_time',
        'professor_id',
        'department_id',
        'subject_id',
        'room_id',
        'block_id'
    ];

    public function professor() {
        return $this->belongsTo('App\User');
    }

    public function room() {
        return $this->belongsTo('App\Room');
    }

    public function subject() {
        return $this->belongsTo('App\Subject');
    }

    public function block() {
        return $this->belongsTo('App\Block');
    }
}
