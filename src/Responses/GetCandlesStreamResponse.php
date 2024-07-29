<?php

namespace Timirey\XApi\Responses;

use Timirey\XApi\Responses\Data\CandleStreamRecord;

/**
 * Class that contains the response of the getCandles stream command.
 */
final readonly class GetCandlesStreamResponse extends AbstractStreamResponse
{
    /**
     * Constructor for the GetCandlesStreamResponse class.
     *
     * @param  CandleStreamRecord $candleStreamRecord Candle record data.
     */
    public function __construct(public CandleStreamRecord $candleStreamRecord)
    {
    }

    /**
     * Create an instance from the validated data.
     *
     * @param  array<string, mixed> $response Validated response data.
     * @return static Instance of the response.
     */
    protected static function create(array $response): self
    {
        return new self(new CandleStreamRecord(...$response));
    }
}
