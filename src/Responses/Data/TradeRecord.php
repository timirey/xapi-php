<?php

namespace Timirey\XApi\Responses\Data;

use Timirey\XApi\Enums\Cmd;

/**
 * Class representing a trade record.
 */
class TradeRecord
{
    /**
     * @var Cmd Operation code.
     */
    public Cmd $cmd;

    /**
     * Constructor for TradeRecord.
     *
     * @param float $close_price Close price in base currency.
     * @param int|null $close_time Null if order is not closed.
     * @param string|null $close_timeString Null if order is not closed.
     * @param bool $closed Closed.
     * @param int $cmd Operation code.
     * @param string $comment Comment.
     * @param float|null $commission Commission in account currency, null if not applicable.
     * @param string|null $customComment The value the customer may provide in order to retrieve it later.
     * @param int $digits Number of decimal places.
     * @param int|null $expiration Null if order is not closed.
     * @param string|null $expirationString Null if order is not closed.
     * @param float $margin_rate Margin rate.
     * @param int $offset Trailing offset.
     * @param float $open_price Open price in base currency.
     * @param int $open_time Open time.
     * @param string $open_timeString Open time string.
     * @param int $order Order number for opened transaction.
     * @param int|null $order2 Order number for closed transaction.
     * @param int $position Order number common both for opened and closed transaction.
     * @param float $profit Profit in account currency.
     * @param float $sl Zero if stop loss is not set (in base currency).
     * @param float $storage Order swaps in account currency.
     * @param string|null $symbol Symbol name or null for deposit/withdrawal operations.
     * @param int $timestamp Timestamp.
     * @param float $tp Zero if take profit is not set (in base currency).
     * @param float $volume Volume in lots.
     */
    public function __construct(
        public float $close_price,
        public ?int $close_time,
        public ?string $close_timeString,
        public bool $closed,
        int $cmd,
        public string $comment,
        public ?float $commission,
        public ?string $customComment,
        public int $digits,
        public ?int $expiration,
        public ?string $expirationString,
        public float $margin_rate,
        public int $offset,
        public float $open_price,
        public int $open_time,
        public string $open_timeString,
        public int $order,
        public ?int $order2,
        public int $position,
        public float $profit,
        public float $sl,
        public float $storage,
        public ?string $symbol,
        public int $timestamp,
        public float $tp,
        public float $volume
    ) {
        $this->cmd = Cmd::from($cmd);
    }
}
