<?php

namespace Timirey\XApi\Responses;

use Timirey\XApi\Responses\Data\TradeStreamRecord;

/**
 * Class that contains the response of the getTrades stream command.
 */
class GetTradesStreamResponse extends AbstractStreamResponse
{
    /**
     * Constructor for the GetTradesStreamResponse class.
     *
     * @param  TradeStreamRecord $tradeStreamRecord Trade record data.
     */
    public function __construct(public TradeStreamRecord $tradeStreamRecord)
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
        return new static(new TradeStreamRecord(...$response['data']));
    }
}
