<?php

namespace Timirey\XApi\Responses\Data;

use Timirey\XApi\Enums\Day;

/**
 * Class representing a quotes record.
 */
class QuotesRecord
{
    /**
     * @var Day Day of week.
     */
    public Day $day;

    /**
     * Constructor for QuotesRecord.
     *
     * @param int $day Day of week.
     * @param int $fromT Start time in ms from 00:00 CET / CEST time zone.
     * @param int $toT End time in ms from 00:00 CET / CEST time zone.
     */
    public function __construct(int $day, public int $fromT, public int $toT)
    {
        $this->day = Day::from($day);
    }
}
