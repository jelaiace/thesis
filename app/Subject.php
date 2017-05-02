<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'course_number',
        'course_code',
        'name',
        'units',
        'department_id'
    ];
    protected $dates =[
        'deleted_at'
    ];

    public function department() {
        return $this->belongsTo('App\Department');
    }
}
