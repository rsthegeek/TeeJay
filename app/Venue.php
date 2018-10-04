<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    protected $guarded = [];
    protected $hidden = [
        'id', 'created_at', 'updated_at', 'complex_id'
    ];
    public function classes()
    {
        return $this->hasMany(UniClass::class);
    }

    public function complex()
    {
        return $this->belongsTo(Complex::class);
    }
}
