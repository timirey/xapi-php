<?php

namespace Timirey\XApi\Payloads\Data;

use Timirey\XApi\Payloads\Enums\Period;

/**
 * Class representing the range chart information record.
 *
 * todo: make period behave as an enum.
 */
class ChartRangeInfoRecord
{
    /**
     * Constructor for ChartRangeInfoRecord.
     *
     * @param Period $period Period code.
     * @param int $start Start of chart block (milliseconds since epoch).
     * @param int $end End of chart block (milliseconds since epoch).
     * @param string $symbol Symbol.
     * @param int|null $ticks Number of ticks needed (optional).
     */
    public function __construct(
        public Period $period,
        public int $start,
        public int $end,
        public string $symbol,
        public ?int $ticks = null
    ) {
    }
}
