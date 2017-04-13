<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Schedule extends Model
{
    protected $fillable = [
        'name',
        'start_time',
        'end_time',
        'professor_id',
        'department_id',
        'subject_id',
        'room_id',
        'block_id',
        'requester_id'
    ];

    protected $appends = [
        'is_pending'
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

    public function requester() {
        return $this->belongsTo('App\User', 'requester_id');
    }

    public function getDayValueAttribute() {
        switch($this->day) {
            case 'mth': return 1;
            case 'tf': return 2;
            case 'ws': return 3;
        }
    }

    public function getFormattedStartTimeAttribute() {
        return date('g:i a', strtotime($this->start_time));
    }

    public function getFormattedEndTimeAttribute() {
        return date('g:i a', strtotime($this->end_time));
    }

    public function getFormattedTimeAttribute() {
        return "{$this->formatted_start_time} - {$this->formatted_end_time}";
    }

    public function getIncrementDifferenceAttribute() {
        $start = Carbon::parse($this->start_time);
        $end = Carbon::parse($this->end_time);
        dd($start->diffInHours($end));
        return $start->diffInHours($end);
    }

    public function getIsPendingAttribute() {
        return $this->status === 'pending';
    }

    public function scopeConfirmed() {
        return $this->where(function($query) {
            $query->where('status', 'approved')
                ->orWhere('status', 'IS', null);
        });
    }
}
