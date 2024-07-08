<?php

namespace Timirey\XApi\Responses\Data;

use DateTime;
use Timirey\XApi\Enums\Day;
use Timirey\XApi\Helpers\DateTimeHelper;

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
     * @var DateTime Start time from 00:00 CET / CEST time zone.
     */
    public DateTime $fromT;

    /**
     * @var DateTime End time from 00:00 CET / CEST time zone.
     */
    public DateTime $toT;

    /**
     * Constructor for QuotesRecord.
     *
     * @param integer $day   Day of week.
     * @param integer $fromT Start time in ms from 00:00 CET / CEST time zone.
     * @param integer $toT   End time in ms from 00:00 CET / CEST time zone.
     */
    public function __construct(int $day, int $fromT, int $toT)
    {
        $this->day = Day::from($day);
        $this->fromT = DateTimeHelper::fromMilliseconds($fromT);
        $this->toT = DateTimeHelper::fromMilliseconds($toT);
    }
}
