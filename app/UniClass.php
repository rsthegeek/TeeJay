<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UniClass extends Model
{
    protected $table = 'classes';
    protected $guarded = [];
    protected $casts = [
        'status15' => 'boolean',
        'status17' => 'boolean',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'exam_date'
    ];

    public function sessionDayName()
    {
        $dayNames = [
            'شنبه', 'یک‌شنبه', 'دو‌شنبه', 'سه‌شنبه', 'چهار‌شنبه', 'پنج‌شنبه', 'جمعه',
        ];

    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }

    public function firstSession()
    {
        return $this->belongsTo(Session::class);
    }

    public function secondSession()
    {
        return $this->belongsTo(Session::class);
    }

    public function thirdSession()
    {
        return $this->belongsTo(Session::class);
    }
}
