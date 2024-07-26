<?php

namespace Timirey\XApi\Responses;

use Override;

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

    /**
     * Create a response instance from the validated data.
     *
     * @param array<string, mixed> $response Validated response data.
     * @return static Instance of the response.
     */
    #[Override]
    protected static function create(array $response): self
    {
        return new self(...$response['returnData']);
    }
}
