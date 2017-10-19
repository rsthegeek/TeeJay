<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $guarded = [];

    public function classesAsFirstSession()
    {
        $this->hasMany(UniClass::class, 'first_session');
    }

    public function classesAsSeconsSession()
    {
        $this->hasMany(UniClass::class, 'secons_session');
    }

    public function classesAsThirdSession()
    {
        $this->hasMany(UniClass::class, 'third_session');
    }
}
