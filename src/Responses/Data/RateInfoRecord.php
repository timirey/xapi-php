<?php

namespace Timirey\XApi\Responses\Data;

use DateTime;
use Timirey\XApi\Helpers\DateTimeHelper;

/**
 * Class representing a rate information record.
 */
class RateInfoRecord
{
    /**
     * @var DateTime Candle start time in CET / CEST time zone.
     */
    public DateTime $ctm;

    /**
     * Constructor for RateInfoRecord.
     *
     * @param  float   $close     Value of close price (shift from open price).
     * @param  integer $ctm       Candle start time in CET / CEST time zone (milliseconds since epoch).
     * @param  string  $ctmString String representation of the 'ctm' field.
     * @param  float   $high      Highest value in the given period (shift from open price).
     * @param  float   $low       Lowest value in the given period (shift from open price).
     * @param  float   $open      Open price (in base currency * 10 to the power of digits).
     * @param  float   $vol       Volume in lots.
     */
    public function __construct(
        public float $close,
        int $ctm,
        public string $ctmString,
        public float $high,
        public float $low,
        public float $open,
        public float $vol
    ) {
        $this->ctm = DateTimeHelper::fromMilliseconds($ctm);
    }
}
