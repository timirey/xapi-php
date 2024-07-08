<?php

namespace Timirey\XApi\Responses;

use Timirey\XApi\Responses\Data\StreamBalanceRecord;

/**
 * Class that contains the response of the getBalance stream command.
 */
class GetBalanceStreamResponse extends AbstractStreamResponse
{
    /**
     * Constructor for the GetBalanceStreamResponse class.
     *
     * @param StreamBalanceRecord $streamBalanceRecord Balance record data.
     */
    public function __construct(public StreamBalanceRecord $streamBalanceRecord)
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
        return new static(new StreamBalanceRecord(...$response['data']));
    }
}
