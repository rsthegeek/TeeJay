<?php

namespace app\Helpers;

class Parse
{

    /**
     * parse class exam time
     *
     * @param $examTime
     * @return mixed
     */
    public static function examTime($examTime)
    {
        $examTimeString2Number = [
            'چهارم' => 4,
            'سوم' => 3,
            'دوم' => 2,
            'يكم' => 1,
            '' => null,
        ];
        return $examTimeString2Number[$examTime];
    }

    /**
     * parse class exam date
     *
     * @param $examDate
     * @return \Carbon\Carbon|null
     */
    public static function examDate($examDate)
    {
        return $examDate == '' ? null : toGregorian($examDate, '۔');
    }

    public static function allowedGender($allowedGender)
    {
        $genders = [
            'c' => false, //girl
            'l' => true, //boy
            '' => null,
        ];
        return $genders[$allowedGender];
    }
}
