<?php

namespace Timirey\XApi\Responses;

/**
 * Class that contains response of the tradeTransaction command.
 */
class TradeTransactionResponse extends AbstractResponse
{
    /**
     * Constructor for TradeTransactionResponse.
     *
     * @param int $order Unique order number.
     */
    public function __construct(public int $order)
    {
    }
}
