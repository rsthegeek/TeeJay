<?php

function toGregorian($dateString, $needle)
{
    $jalaliDateArray = explode($needle, $dateString);
    if (intval($jalaliDateArray[0]) < 31) {
        $jalaliDateArray = array_reverse($jalaliDateArray);
    }

    $gregorianDateArray = Morilog\Jalali\jDateTime::toGregorian(
        ...$jalaliDateArray
    );
    return new Carbon\Carbon(implode('-', $gregorianDateArray));
}

function ar2fa($string)
{
    return str_replace(
        ['ي', 'ك'],
        ['ی', 'ک'],
        $string
    );
}

function faNumerals($string)
{
    return str_replace(
        ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0'],
        ['۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹', '۰'],
        $string
    );
}

function pureFa($string)
{
    return faNumerals(ar2fa($string));
}

function perentesisFix($string)
{
    if (substr($string, 0, 1) === '(') {
        $string = substr($string, 1) . ')';
    }
    return $string;
}


function qRand($length = 8)
{
    $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    return substr(str_shuffle(str_repeat($pool, $length)), 0, $length);
}
