<?php

namespace Timirey\XApi\Helpers;

use DateTime;

/**
 * Date time helper with some custom methods.
 */
class DateTimeHelper
{
    /**
     * PHP DateTime object does not support milliseconds unix timestamp by default.
     *
     * @param int $timestamp
     * @return DateTime
     */
    public static function createFromMilliseconds(int $timestamp): DateTime
    {
        return DateTime::createFromFormat('U.u', sprintf("%d.%03d", $timestamp / 1000, $timestamp % 1000));
    }
}
