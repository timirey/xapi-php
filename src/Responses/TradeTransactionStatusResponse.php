<?php

namespace Timirey\XApi\Responses;

use Timirey\XApi\Enums\RequestStatus;

/**
 * Class that contains response of the tradeTransactionStatus command.
 */
readonly class TradeTransactionStatusResponse extends AbstractResponse
{
    /**
     * @var RequestStatus Request status code.
     */
    public RequestStatus $requestStatus;

    /**
     * Constructor for TradeTransactionStatusResponse.
     *
     * @param  float       $ask           Ask price in base currency.
     * @param  float       $bid           Bid price in base currency.
     * @param  string|null $customComment The value the customer may provide in order to retrieve it later.
     * @param  string      $message       Can be null.
     * @param  integer     $order         Unique order number.
     * @param  integer     $requestStatus Request status code.
     */
    final public function __construct(
        public float $ask,
        public float $bid,
        public ?string $customComment,
        public string $message,
        public int $order,
        int $requestStatus,
    ) {
        $this->requestStatus = RequestStatus::from($requestStatus);
    }
}
