<?php

namespace Timirey\XApi\Responses;

use Timirey\XApi\Responses\Data\StreamTickRecord;

/**
 * Class that contains the response of the getTickPrices stream command.
 */
class GetTickPricesStreamResponse extends AbstractStreamResponse
{
    /**
     * Constructor for the GetTickPricesStreamResponse class.
     *
     * @param StreamTickRecord $streamTickRecord Tick record data.
     */
    public function __construct(public StreamTickRecord $streamTickRecord)
    {
    }

    /**
     * Create an instance from the validated data.
     *
     * @param array<string, mixed> $response Validated response data.
     *
     * @return static Instance of the response.
     */
    protected static function create(array $response): static
    {
        return new static(new StreamTickRecord(...$response['data']));
    }
}
