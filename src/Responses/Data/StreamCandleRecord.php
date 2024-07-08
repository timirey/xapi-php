<?php

namespace Timirey\XApi\Responses\Data;

use Timirey\XApi\Enums\QuoteId;

/**
 * Class representing the candle record data in the streaming response.
 */
class StreamCandleRecord
{
    /**
     * @var QuoteId Source of price.
     */
    public QuoteId $quoteId;

    /**
     * Constructor for the StreamCandleRecord class.
     *
     * @param float   $close     Close price.
     * @param integer $ctm       Candle start time in CET time zone.
     * @param string  $ctmString String representation of the ctm field.
     * @param float   $high      Highest value in the given period.
     * @param float   $low       Lowest value in the given period.
     * @param float   $open      Open price.
     * @param integer $quoteId   Source of price.
     * @param string  $symbol    Symbol.
     * @param float   $vol       Volume in lots.
     */
    public function __construct(
        public float $close,
        public int $ctm,
        public string $ctmString,
        public float $high,
        public float $low,
        public float $open,
        int $quoteId,
        public string $symbol,
        public float $vol
    ) {
        $this->quoteId = QuoteId::from($quoteId);
    }
}
