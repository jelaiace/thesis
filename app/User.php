<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Department;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'department_id', 'type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be appended to the JSON-serialized model
     *
     * @var array
     */
    protected $appends = [
        'name'
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function getNameAttribute() {
        return "{$this->first_name} {$this->last_name}";
    }

    public function department()
    {
        return $this->belongsTo('App\Department')->withTrashed();
    }

    public function schedules()
    {
        return $this->hasMany('App\Schedule', 'professor_id');
    }

    public function requests() {
        return $this->hasMany('App\Schedule', 'requester_id');
    }

    public function scopeOfType($query, $type) {
        return $query->where('type', $type);
    }
}
