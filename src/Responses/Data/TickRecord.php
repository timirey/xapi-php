<?php

namespace Timirey\XApi\Responses\Data;

use Timirey\XApi\Responses\Enums\Level;

/**
 * Class representing a tick record.
 */
class TickRecord
{
    /**
     * @var Level Price level.
     */
    public Level $level;

    /**
     * Constructor for TickRecord.
     *
     * @param float $ask Ask price in base currency.
     * @param int|null $askVolume Number of available lots to buy at given price or null if not applicable.
     * @param float $bid Bid price in base currency.
     * @param int|null $bidVolume Number of available lots to buy at given price or null if not applicable.
     * @param float $high The highest price of the day in base currency.
     * @param int $level Price level.
     * @param int $exemode [No description].
     * @param float $low The lowest price of the day in base currency.
     * @param float $spreadRaw The difference between raw ask and bid prices.
     * @param float $spreadTable Spread representation.
     * @param string $symbol Symbol.
     * @param int $timestamp Timestamp.
     */
    public function __construct(
        public float $ask,
        public ?int $askVolume,
        public float $bid,
        public ?int $bidVolume,
        public float $high,
        int $level,
        public int $exemode,
        public float $low,
        public float $spreadRaw,
        public float $spreadTable,
        public string $symbol,
        public int $timestamp
    ) {
        $this->level = Level::from($level);
    }
}
