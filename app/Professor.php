<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Professor extends Model
{
    protected $fillable = [
    'name',
    'department_id'
    ];

    public function department()
    {
        return $this->belongsTo('App\Department');
    }

    public function user() {
        return $this->belongsTo('App/User');
    }

    public function department() {
        return $this->hasMany('App/Department')
    }
}
