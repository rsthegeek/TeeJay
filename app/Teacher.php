<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $guarded = [];
    protected $hidden = [
        'id', 'created_at', 'updated_at'
    ];
    public function classes()
    {
        return $this->hasMany(UniClass::class);
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
