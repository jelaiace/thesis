<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    Protected $fillable = [
    'course_code',
    'name',
    'units'
    ];
}
