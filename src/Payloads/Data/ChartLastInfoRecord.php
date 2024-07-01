<?php

namespace Timirey\XApi\Payloads\Data;

use Timirey\XApi\Enums\Period;

/**
 * Class representing the last chart information record.
 *
 * todo: start should be DateTime?
 */
class ChartLastInfoRecord
{
    /**
     * Constructor for ChartLastInfoRecord.
     *
     * @param Period $period Period code.
     * @param int $start Start of chart block.
     * @param string $symbol Symbol.
     */
    public function __construct(public Period $period, public int $start, public string $symbol)
    {
    }
}
