<?php

namespace Timirey\XApi\Responses;

/**
 * Class that contains the response of the getProfitCalculation command.
 */
readonly class GetProfitCalculationResponse extends AbstractResponse
{
    /**
     * Constructor for GetProfitCalculationResponse.
     *
     * @param  float $profit Profit in account currency.
     */
    final public function __construct(public float $profit)
    {
    }
}
