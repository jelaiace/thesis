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
        return $this->belongsTo('App\User')->withTrashed();
    }

    public function room() {
        return $this->belongsTo('App\Room')->withTrashed();
    }

    public function subject() {
        return $this->belongsTo('App\Subject')->withTrashed();
    }

    public function block() {
        return $this->belongsTo('App\Block')->withTrashed();
    }

    public function requester() {
        return $this->belongsTo('App\User', 'requester_id')->withTrashed();
    }

    public function getDayValueAttribute() {
        switch($this->day) {
            case 'm': return 1;
            case 't': return 2;
            case 'w': return 3;
            case 'th': return 4;
            case 'f': return 5;
            case 's': return 6;
        }
    }

    public function getDayNameAttribute() {
        switch($this->day) {
            case 'm': return 'Monday';
            case 't': return 'Tuesday';
            case 'w': return 'Wednesday';
            case 'th': return 'Thursday';
            case 'f': return 'Friday';
            case 's': return 'Saturday';
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

    public function scopeConfirmed($query) {
        return $query->where(function($sub) {
            return $sub->where('status', 'approved')
                ->orWhereNull('status');
        });
    }

    /**
     * Get all recent schedules (all pending, and recent *approved*
     * and *declined* requests) added since the past week.
     * Intended to be used for recent requests.
     */
    public function scopeRecent($query) {
        // Avoid MySQL *ambiguous errors* when
        // scope is used within a join query.
        $table = $this->getTable();

        return $query->where(function($query) use($table) {
            return $query->where(function($query) use($table) {
                return $query->where("{$table}.status", '!=', 'pending')
                    ->where("{$table}.created_at", '>=', Carbon::now()->subWeek());
            })->orWhere("{$table}.status", 'pending');
        });
    }

    // Check start and end time are not the same
    // Check if there are overlapping schedules
    // Must start before and after start
    // Must end before and after end
    public function scopeConflicting($query, $block, $start, $end, $day, $ignore = null) {
        $query->where('block_id', $block)
            ->where('start_time', '<', $end)
            ->where('end_time', '>', $start)
            ->where('day', $day)
            ->where(function($sub) {
                return $sub->where('status', '!=', 'declined')
                    ->orWhereNull('status');
            });

        if ($ignore) {
            $query->where('id', '!=', $ignore);
        }

        return $query;
    }
}
