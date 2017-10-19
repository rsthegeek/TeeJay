<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    protected $guarded = [];

    public function classes()
    {
        return $this->hasMany(UniClass::class);
    }

    public function complex()
    {
        return $this->belongsTo(Complex::class);
    }
}
