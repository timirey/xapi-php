<?php

namespace Timirey\XApi\Responses\Data;

use DateTime;
use Timirey\XApi\Enums\Impact;
use Timirey\XApi\Helpers\DateTimeHelper;

/**
 * Class representing a calendar record.
 *
 * todo: time should be DateTime?
 */
class CalendarRecord
{
    /**
     * @var Impact Impact on market.
     */
    public Impact $impact;

    /**
     * @var DateTime Time when the information will be released.
     */
    public DateTime $time;

    /**
     * Constructor for CalendarRecord.
     *
     * @param string $country Two-letter country code.
     * @param string $current Market value (current), empty before time of release.
     * @param string $forecast Forecasted value.
     * @param string $impact Impact on market.
     * @param string $period Information period.
     * @param string $previous Value from previous information release.
     * @param int $time Time when the information will be released.
     * @param string $title Name of the indicator for which values will be released.
     */
    public function __construct(
        public string $country,
        public string $current,
        public string $forecast,
        string $impact,
        public string $period,
        public string $previous,
        int $time,
        public string $title
    ) {
        $this->impact = Impact::from($impact);
        $this->time = DateTimeHelper::createFromMilliseconds($time);
    }
}
