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

    /**
     * Create a response instance from the validated data.
     *
     * @param array<string, mixed> $response Validated response data.
     * @return static Instance of the response.
     */
    #[Override]
    protected static function create(array $response): self
    {
        return new self(...$response);
    }
}
