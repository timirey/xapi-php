<?php

namespace Timirey\XApi\Responses\Data;

/**
 * Class representing a rate information record.
 *
 * todo: ctm should be DateTime?
 */
class RateInfoRecord
{
    /**
     * Constructor for RateInfoRecord.
     *
     * @param float $close Value of close price (shift from open price).
     * @param int $ctm Candle start time in CET / CEST time zone (milliseconds since epoch).
     * @param string $ctmString String representation of the 'ctm' field.
     * @param float $high Highest value in the given period (shift from open price).
     * @param float $low Lowest value in the given period (shift from open price).
     * @param float $open Open price (in base currency * 10 to the power of digits).
     * @param float $vol Volume in lots.
     */
    public function __construct(
        public float $close,
        public int $ctm,
        public string $ctmString,
        public float $high,
        public float $low,
        public float $open,
        public float $vol
    ) {
    }
}
