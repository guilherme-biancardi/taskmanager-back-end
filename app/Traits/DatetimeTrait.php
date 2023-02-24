<?php

namespace App\Traits;

use DateTime;
use DateTimeZone;

trait DatetimeTrait
{
    public function convertDateToTimezone($date, $format, $timezone)
    {
        $date = DateTime::createFromFormat($format, $date);
        $timezone = new DateTimeZone($timezone);

        return $date->setTimezone($timezone);
    }

    function validateDate($date, $format = 'Y-m-d')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }
}
