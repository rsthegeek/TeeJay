<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    protected $guarded = [];

    public function students()
    {
        $this->hasMany(User::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'field_courses')
            ->withTimestamps();
    }
}
