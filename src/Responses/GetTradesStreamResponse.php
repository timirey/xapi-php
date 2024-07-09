<?php

namespace Timirey\XApi\Responses;

use Timirey\XApi\Responses\Data\StreamTradeRecord;

/**
 * Class that contains the response of the getTrades stream command.
 */
class GetTradesStreamResponse extends AbstractStreamResponse
{
    /**
     * Constructor for the GetTradesStreamResponse class.
     *
     * @param  StreamTradeRecord $streamTradeRecord Trade record data.
     */
    public function __construct(public StreamTradeRecord $streamTradeRecord)
    {
    }

    /**
     * Create an instance from the validated data.
     *
     * @param  array<string, mixed> $response Validated response data.
     * @return static Instance of the response.
     */
    protected static function create(array $response): static
    {
        return new static(new StreamTradeRecord(...$response['data']));
    }
}
