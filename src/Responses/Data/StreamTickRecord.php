<?php

namespace Timirey\XApi\Responses\Data;

use DateTime;
use Timirey\XApi\Enums\QuoteId;
use Timirey\XApi\Helpers\DateTimeHelper;

/**
 * Class representing the tick record data in the streaming response.
 */
class StreamTickRecord
{
    /**
     * @var DateTime Timestamp.
     */
    public DateTime $timestamp;

    /**
     * @var QuoteId Source of price.
     */
    public QuoteId $quoteId;

    /**
     * Constructor for the StreamTickRecord class.
     *
     * @param float    $ask         Ask price.
     * @param int|null $askVolume   Number of available lots to buy at given price or null if not applicable.
     * @param float    $bid         Bid price.
     * @param int|null $bidVolume   Number of available lots to buy at given price or null if not applicable.
     * @param float    $high        The highest price of the day in base currency.
     * @param int      $level       Price level.
     * @param float    $low         The lowest price of the day in base currency.
     * @param int      $quoteId     Source of price.
     * @param float    $spreadRaw   The difference between raw ask and bid prices.
     * @param float    $spreadTable Spread representation.
     * @param string   $symbol      Symbol.
     * @param int      $timestamp   Timestamp.
     */
    public function __construct(
        public float $ask,
        public ?int $askVolume,
        public float $bid,
        public ?int $bidVolume,
        public float $high,
        public int $level,
        public float $low,
        int $quoteId,
        public float $spreadRaw,
        public float $spreadTable,
        public string $symbol,
        int $timestamp
    ) {
        $this->quoteId = QuoteId::from($quoteId);
        $this->timestamp = DateTimeHelper::fromMilliseconds($timestamp);
    }
}
