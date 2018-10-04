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

    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
        'venue_id',
        'teacher_id',
        'course_id',
        'first_session_id',
        'second_session_id',
        'third_session_id',
    ];

    public static $dayNames = [
        'شنبه', 'یک‌شنبه', 'دو‌شنبه', 'سه‌شنبه', 'چهار‌شنبه', 'پنج‌شنبه', 'جمعه',
    ];

    public static $orderables = [
        ['column' => 'course_id', 'name' => 'درس'],
        ['column' => 'teacher_id', 'name' => 'کلاس'],
        ['column' => 'first_session_day', 'name' => 'روز اول'],
        ['column' => 'first_session_id', 'name' => 'ساعت اول'],
        ['column' => 'second_session_day', 'name' => 'روز دوم'],
        ['column' => 'second_session_id', 'name' => 'ساعت دوم'],
        ['column' => 'third_session_day', 'name' => 'روز سوم'],
        ['column' => 'third_session_id', 'name' => 'ساعت سوم'],
        ['column' => 'exam_time', 'name' => 'زمان امتحان'],
        ['column' => 'exam_date', 'name' => 'تاریخ امتحان'],
        ['column' => 'remainingCap', 'name' => 'ظرفیت باقی‌مانده'],
        ['column' => 'boysCount', 'name' => 'تعداد پسران کلاس'],
        ['column' => 'girlsCount', 'name' => 'تعداد دختران کلاس'],
        // ['column' => 'allowedGender', 'name' => 'جنسیت مجاز'],
        // ['column' => 'created_at', 'name' => 'تاریخ ایجاد'],
    ];

    public function getFirstSessionDayTitleAttribute()
    {
        return isset(self::$dayNames[$this->first_session_day]) ?
            self::$dayNames[$this->first_session_day] :
            $this->first_session_day;
    }

    public function getRouteKeyName()
    {
        return 'code';
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
