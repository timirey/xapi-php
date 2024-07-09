<?php

namespace Timirey\XApi\Payloads\Data;

use DateTime;
use Timirey\XApi\Enums\Period;
use Timirey\XApi\Helpers\DateTimeHelper;

/**
 * Class representing the range chart information record.
 */
class ChartRangeInfoRecord
{
    /**
     * @var integer Start of chart block (milliseconds since epoch).
     */
    public int $start;

    /**
     * @var integer End of chart block (milliseconds since epoch).
     */
    public int $end;

    /**
     * Constructor for ChartRangeInfoRecord.
     *
     * @param  Period       $period Period code.
     * @param  DateTime     $start  Start of chart block.
     * @param  DateTime     $end    End of chart block.
     * @param  string       $symbol Symbol.
     * @param  integer|null $ticks  Number of ticks needed (optional).
     */
    public function __construct(
        public Period $period,
        DateTime $start,
        DateTime $end,
        public string $symbol,
        public ?int $ticks = null
    ) {
        $this->start = DateTimeHelper::toMilliseconds($start);
        $this->end = DateTimeHelper::toMilliseconds($end);
    }
}
