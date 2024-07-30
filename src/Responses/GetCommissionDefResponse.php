<?php

namespace Timirey\XApi\Responses;

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
}
