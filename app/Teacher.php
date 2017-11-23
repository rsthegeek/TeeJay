<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $guarded = [];

    public function classes()
    {
        return $this->hasMany(UniClass::class);
    }
}