<?php

namespace Timirey\XApi\Responses;

use Override;

/**
 * Class that contains the response of the getMarginTrade command.
 */
final readonly class GetMarginTradeResponse extends AbstractResponse
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
