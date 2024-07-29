<?php

namespace Timirey\XApi\Responses;

use Override;

/**
 * Class that contains the response of the getMarginLevel command.
 */
final readonly class GetMarginLevelResponse extends AbstractResponse
{
    /**
     * Constructor for GetMarginLevelResponse.
     *
     * @param  float  $balance     Balance in account currency.
     * @param  float  $credit      Credit.
     * @param  string $currency    User currency.
     * @param  float  $equity      Sum of balance and all profits in account currency.
     * @param  float  $margin      Margin requirements in account currency.
     * @param  float  $marginFree  Free margin in account currency.
     * @param  float  $marginLevel Margin level percentage.
     */
    public function __construct(
        public float $balance,
        public float $credit,
        public string $currency,
        public float $equity,
        public float $margin,
        public float $marginFree,
        public float $marginLevel
    ) {
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
