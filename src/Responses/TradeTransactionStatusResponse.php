<?php

namespace Timirey\XApi\Responses;

use Override;
use Timirey\XApi\Enums\RequestStatus;

/**
 * Class that contains response of the tradeTransactionStatus command.
 */
final readonly class TradeTransactionStatusResponse extends AbstractResponse
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
    public function __construct(
        public float $ask,
        public float $bid,
        public ?string $customComment,
        public string $message,
        public int $order,
        int $requestStatus,
    ) {
        $this->requestStatus = RequestStatus::from($requestStatus);
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
