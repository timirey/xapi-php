<?php

namespace Timirey\XApi\Responses;

use Override;

/**
 * Class that contains the response of the login command.
 */
final readonly class GetCommissionDefResponse extends AbstractResponse
{
    /**
     * Constructor for LoginResponse.
     *
     * @param float      $commission     Calculated commission in account currency, could be null if not applicable.
     * @param float|null $rateOfExchange Rate of exchange between account currency and instrument base currency,
     *                                    could be null if not applicable.
     */
    public function __construct(public float $commission, public ?float $rateOfExchange)
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
