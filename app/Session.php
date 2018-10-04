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

    public function toString()
    {
        // G:i
        return
            faNumerals(substr($this->starts_at, 0, -3)).
            ' ~ '.
            faNumerals(substr($this->ends_at, 0, -3));
    }
}
