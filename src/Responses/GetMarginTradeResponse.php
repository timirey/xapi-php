<?php

namespace Timirey\XApi\Responses;

/**
 * Class that contains the response of the getMarginTrade command.
 */
class GetMarginTradeResponse extends AbstractResponse
{
    /**
     * Constructor for GetMarginTradeResponse.
     *
     * @param  float $margin Calculated margin in account currency.
     */
    public function __construct(public float $margin)
    {
    }
}
