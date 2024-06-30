<?php

namespace Timirey\XApi\Responses;

/**
 * Class that contains the response of the getMarginLevel command.
 */
class GetMarginLevelResponse extends AbstractResponse
{
    /**
     * Constructor for GetMarginLevelResponse.
     *
     * @param float $balance Balance in account currency.
     * @param float $credit Credit.
     * @param string $currency User currency.
     * @param float $equity Sum of balance and all profits in account currency.
     * @param float $margin Margin requirements in account currency.
     * @param float $marginFree Free margin in account currency.
     * @param float $marginLevel Margin level percentage.
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
}
