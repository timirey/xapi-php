<?php

namespace Timirey\XApi\Responses\Data;

use DateTime;
use Timirey\XApi\Enums\QuoteId;
use Timirey\XApi\Helpers\DateTimeHelper;

/**
 * Class representing the candle record data in the streaming response.
 */
class CandleStreamRecord
{
    /**
     * @var QuoteId Source of price.
     */
    public QuoteId $quoteId;

    /**
     * @var DateTime Candle start time in CET time zone.
     */
    public DateTime $ctm;

    /**
     * Constructor for the CandleStreamRecord class.
     *
     * @param  float   $close     Close price.
     * @param  integer $ctm       Candle start time in CET time zone.
     * @param  string  $ctmString String representation of the ctm field.
     * @param  float   $high      Highest value in the given period.
     * @param  float   $low       Lowest value in the given period.
     * @param  float   $open      Open price.
     * @param  integer $quoteId   Source of price.
     * @param  string  $symbol    Symbol.
     * @param  float   $vol       Volume in lots.
     */
    public function __construct(
        public float $close,
        int $ctm,
        public string $ctmString,
        public float $high,
        public float $low,
        public float $open,
        int $quoteId,
        public string $symbol,
        public float $vol
    ) {
        $this->quoteId = QuoteId::from($quoteId);
        $this->ctm = DateTimeHelper::fromMilliseconds($ctm);
    }
}
