<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Block extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'course_id',
        'year_level',
        'semester'
    ];

    protected $dates = [
        'deleted_at'
    ];

    /**
     * @source http://stackoverflow.com/a/3110033/2698227
     */
    public function getOrdinalYearLevelAttribute() {
        $n = $this->year_level;
        $ends = ['th','st','nd','rd','th','th','th','th','th','th'];
        if ((($n % 100) >= 11) && (($n % 100) <= 13)) {
            return $n. 'th';
        } else {
            return $n . $ends[$n % 10];
        }
    }

    public function getFullOrdinalYearLevelAttribute() {
        return "{$this->ordinal_year_level} Year";
    }    

    public function course() {
        return $this->belongsTo('App\Course')->withTrashed();
    }

    public function schedules() {
        return $this->hasMany('App\Schedule');
    }
}
