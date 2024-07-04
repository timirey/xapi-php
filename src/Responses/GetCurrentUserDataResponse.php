<?php

namespace Timirey\XApi\Responses;

/**
 * Class that contains the response of the getCurrentUserData command.
 */
class GetCurrentUserDataResponse extends AbstractResponse
{
    /**
     * Constructor for GetCurrentUserDataResponse.
     *
     * @param int         $companyUnit        Unit the account is assigned to.
     * @param string      $currency           Account currency.
     * @param string      $group              Group.
     * @param bool        $ibAccount          Indicates whether this account is an IB account.
     * @param int         $leverage           This field should not be used. It is inactive and its value is always 1.
     * @param float       $leverageMultiplier The factor used for margin calculations.
     * @param string|null $spreadType         Spread type, null if not applicable.
     * @param bool        $trailingStop       Indicates whether this account is enabled to use trailing stop.
     */
    public function __construct(
        public int $companyUnit,
        public string $currency,
        public string $group,
        public bool $ibAccount,
        public int $leverage,
        public float $leverageMultiplier,
        public ?string $spreadType,
        public bool $trailingStop
    ) {
    }
}
