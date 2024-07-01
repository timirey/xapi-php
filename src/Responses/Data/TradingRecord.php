<?php

namespace Timirey\XApi\Responses\Data;

use Timirey\XApi\Enums\Day;

/**
 * Class representing a trading record.
 */
class TradingRecord
{
    /**
     * @var Day Day of week.
     */
    public Day $day;

    /**
     * Constructor for TradingRecord.
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
