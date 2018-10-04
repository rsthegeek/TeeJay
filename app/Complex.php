<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Complex extends Model
{
    protected $guarded = [];
    protected $hidden = [
        'id', 'created_at', 'updated_at'
    ];
    public function venues()
    {
        return $this->hasMany(Venue::class);
    }
}
