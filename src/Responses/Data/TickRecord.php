<?php

namespace Timirey\XApi\Responses\Data;

use DateTime;
use Timirey\XApi\Enums\Level;
use Timirey\XApi\Helpers\DateTimeHelper;

/**
 * Class representing a tick record.
 */
readonly class TickRecord
{
    /**
     * @var Level Price level.
     */
    public Level $level;

    /**
     * @var DateTime Timestamp.
     */
    public DateTime $timestamp;

    /**
     * Constructor for TickRecord.
     *
     * @param  float        $ask         Ask price in base currency.
     * @param  integer|null $askVolume   Number of available lots to buy at given price or null if not applicable.
     * @param  float        $bid         Bid price in base currency.
     * @param  integer|null $bidVolume   Number of available lots to buy at given price or null if not applicable.
     * @param  float        $high        The highest price of the day in base currency.
     * @param  integer      $level       Price level.
     * @param  integer      $exemode     Execution mode.
     * @param  float        $low         The lowest price of the day in base currency.
     * @param  float        $spreadRaw   The difference between raw ask and bid prices.
     * @param  float        $spreadTable Spread representation.
     * @param  string       $symbol      Symbol.
     * @param  integer      $timestamp   Timestamp.
     */
    final public function __construct(
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
        int $timestamp
    ) {
        $this->level = Level::from($level);

        $this->timestamp = DateTimeHelper::fromMilliseconds($timestamp);
    }
}
