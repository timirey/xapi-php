<?php

namespace Timirey\XApi\Helpers;

use DateTime;

/**
 * DateTimeHelper class provides methods to handle DateTime objects with millisecond precision.
 */
class DateTimeHelper
{
    /**
     * Creates a DateTime object from a timestamp with milliseconds.
     *
     * @param integer $timestamp The timestamp in milliseconds.
     * @return DateTime The created DateTime object.
     *
     * todo: rename this function.
     */
    public static function fromMilliseconds(int $timestamp): DateTime
    {
        return DateTime::createFromFormat('U.u', sprintf('%d.%03d', $timestamp / 1000, $timestamp % 1000));
    }

    /**
     * Converts a DateTime object to a timestamp in milliseconds.
     *
     * @param DateTime $dateTime The DateTime object to convert.
     * @return integer The timestamp in milliseconds.
     *
     * todo: rename this function.
     */
    public static function toMilliseconds(DateTime $dateTime): int
    {
        return (int) ($dateTime->format('U.u') * 1000);
    }
}
