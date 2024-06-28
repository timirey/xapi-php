<?php

namespace Timirey\XApi\Payloads\Data;

/**
 * Class representing the last chart information record.
 *
 * todo: make period behave as an enum.
 * todo: start should be DateTime?
 */
class ChartLastInfoRecord
{
    /**
     * Constructor for ChartLastInfoRecord.
     *
     * @param int $period Period code.
     * @param int $start Start of chart block.
     * @param string $symbol Symbol.
     */
    public function __construct(
        public int $period,
        public int $start,
        public string $symbol
    ) {
    }
}
