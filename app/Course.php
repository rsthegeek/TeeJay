<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $guarded = [];

    public function classes()
    {
        return $this->hasMany(UniClass::class);
    }

    public function fields()
    {
        return $this->belongsToMany(Field::class, 'field_courses')
            ->withTimestamps();
    }

    public function studentsTakenThis()
    {
        return $this->belongsToMany(User::class, 'user_taken_courses')
            ->withTimestamps();
    }
}
