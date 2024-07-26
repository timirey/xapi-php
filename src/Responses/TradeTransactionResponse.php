<?php

namespace Timirey\XApi\Responses;

/**
 * Class that contains response of the tradeTransaction command.
 */
readonly class TradeTransactionResponse extends AbstractResponse
{
    /**
     * Constructor for TradeTransactionResponse.
     *
     * @param  integer $order Unique order number.
     */
    final public function __construct(public int $order)
    {
    }
}
