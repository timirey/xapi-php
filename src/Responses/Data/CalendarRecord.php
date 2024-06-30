<?php

namespace Timirey\XApi\Responses\Data;

/**
 * Class representing a calendar record.
 *
 * todo: make impact act as enum.
 * todo: time should be DateTime?
 */
class CalendarRecord
{
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
        public string $impact,
        public string $period,
        public string $previous,
        public int $time,
        public string $title
    ) {
    }
}
