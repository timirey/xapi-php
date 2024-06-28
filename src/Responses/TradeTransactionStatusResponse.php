<?php

namespace Timirey\XApi\Responses;

/**
 * Class that contains response of the tradeTransactionStatus command.
 *
 * todo: make requestStatus behave as enum.
 */
class TradeTransactionStatusResponse extends AbstractResponse
{
    /**
     * Constructor for TradeTransactionStatusResponse.
     *
     * @param float $ask Ask price in base currency.
     * @param float $bid Bid price in base currency.
     * @param string|null $customComment The value the customer may provide in order to retrieve it later.
     * @param string $message Can be null.
     * @param int $order Unique order number.
     * @param int $requestStatus Request status code.
     */
    public function __construct(
        public float $ask,
        public float $bid,
        public ?string $customComment,
        public string $message,
        public int $order,
        public int $requestStatus,
    ) {
    }
}
