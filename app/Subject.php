<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'course_number',
        'course_code',
        'name',
        'units',
        'department_id'
    ];

    public function department() {
        return $this->belongsTo('App\Department');
    }
}
