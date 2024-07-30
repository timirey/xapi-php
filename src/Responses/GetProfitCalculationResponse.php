<?php

namespace Timirey\XApi\Responses;

/**
 * Class that contains the response of the getProfitCalculation command.
 */
final readonly class GetProfitCalculationResponse extends AbstractResponse
{
    /**
     * Constructor for GetProfitCalculationResponse.
     *
     * @param  float $profit Profit in account currency.
     */
    public function __construct(public float $profit)
    {
    }
}
