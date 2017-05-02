<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'department_id'
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function department() {
        return $this->belongsTo('App\Department')->withTrashed();
    }
}
