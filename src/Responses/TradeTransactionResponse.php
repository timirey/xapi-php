<?php

namespace Timirey\XApi\Responses;

use Override;

/**
 * Class that contains response of the tradeTransaction command.
 */
final readonly class TradeTransactionResponse extends AbstractResponse
{
    /**
     * Constructor for TradeTransactionResponse.
     *
     * @param  integer $order Unique order number.
     */
    public function __construct(public int $order)
    {
    }
}
