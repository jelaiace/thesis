<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'name',
        'department_id'
    ];

    public function department() {
        return $this->belongsTo('App\Department');
    }
}
