<?php

namespace Timirey\XApi\Payloads\Data;

use Timirey\XApi\Enums\Period;

/**
 * Class representing the last chart information record.
 *
 * todo: make period behave as an enum.
 * todo: start should be DateTime?
 */
class ChartLastInfoRecord
{
    /**
     * Period code.
     */
    public Period $period;

    /**
     * Constructor for ChartLastInfoRecord.
     *
     * @param int $period Period code.
     * @param int $start Start of chart block.
     * @param string $symbol Symbol.
     */
    public function __construct(int $period, public int $start, public string $symbol)
    {
        $this->period = Period::from($period);
    }
}
