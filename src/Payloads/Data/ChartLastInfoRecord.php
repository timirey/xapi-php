<?php

namespace Timirey\XApi\Payloads\Data;

use DateTime;
use Timirey\XApi\Enums\Period;
use Timirey\XApi\Helpers\DateTimeHelper;

/**
 * Class representing the last chart information record.
 */
class ChartLastInfoRecord
{
    /**
     * @var int Start of chart block (milliseconds since epoch).
     */
    public int $start;

    /**
     * Constructor for ChartLastInfoRecord.
     *
     * @param Period $period Period code.
     * @param DateTime $start Start of chart block.
     * @param string $symbol Symbol.
     */
    public function __construct(public Period $period, DateTime $start, public string $symbol)
    {
        $this->start = DateTimeHelper::toMilliseconds($start);
    }
}
