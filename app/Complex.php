<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Complex extends Model
{
    protected $guarded = [];

    public function venues()
    {
        return $this->hasMany(Venue::class);
    }
}
