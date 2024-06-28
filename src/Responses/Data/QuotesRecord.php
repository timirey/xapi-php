<?php

namespace Timirey\XApi\Responses\Data;

/**
 * Class representing a quotes record.
 */
class QuotesRecord
{
    /**
     * Constructor for QuotesRecord.
     *
     * @param int $day Day of week.
     * @param int $fromT Start time in ms from 00:00 CET / CEST time zone.
     * @param int $toT End time in ms from 00:00 CET / CEST time zone.
     */
    public function __construct(public int $day, public int $fromT, public int $toT)
    {
    }
}
