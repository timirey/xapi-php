<?php

namespace Timirey\XApi\Responses;

use Timirey\XApi\Responses\Data\StreamCandleRecord;

/**
 * Class that contains the response of the getCandles stream command.
 */
class GetCandlesStreamResponse extends AbstractStreamResponse
{
    /**
     * Constructor for the GetCandlesStreamResponse class.
     *
     * @param  StreamCandleRecord $streamCandleRecord Candle record data.
     */
    public function __construct(public StreamCandleRecord $streamCandleRecord)
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
        return new static(new StreamCandleRecord(...$response['data']));
    }
}
