<?php

namespace app\Helpers;

class DaysOfWeek
{
    /**
     * @var Integer
     */
    public $index;

    /**
     * @var String
     */
    public $name;

    /**
     * @var String
     */
    public $shortName;

    protected function __construct($index, $name, $shortName)
    {
        $this->index = $index;
        $this->name = $name;
        $this->shortName = $shortName;
    }

    public static function collection()
    {
        return collect([
            new self(0, 'شنبه',      'ش'),
            new self(1, 'یک‌شنبه',    'ی'),
            new self(2, 'دو‌شنبه',    'د'),
            new self(3, 'سه‌شنبه',    'س'),
            new self(4, 'چهار‌شنبه',  'چ'),
            new self(5, 'پنج‌شنبه',   'پ'),
            new self(6, 'جمعه',      'جم'),
        ]);
    }
}
