<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function field()
    {
        return $this->belongsTo(Field::class);
    }

    public function takenCourses()
    {
        return $this->belongsToMany(Course::class, 'user_taken_courses')
            ->withTimestamps();
    }

    public function passedCourses()
    {
        return $this->takenCourses()->wherePivot('score', '>=', 10);
    }
}
