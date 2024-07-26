<?php

namespace Timirey\XApi\Responses;

use Override;

/**
 * Class that contains response of the tradeTransaction command.
 */
final readonly class TradeTransactionResponse extends AbstractResponse
{
    /**
     * Constructor for TradeTransactionResponse.
     *
     * @param  integer $order Unique order number.
     */
    public function __construct(public int $order)
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
