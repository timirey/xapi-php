<?php

namespace Timirey\XApi\Responses;

use Timirey\XApi\Responses\Data\TradeStatusStreamRecord;

/**
 * Class that contains the response of the getTradeStatus stream command.
 */
readonly class GetTradeStatusStreamResponse extends AbstractStreamResponse
{
    /**
     * Constructor for the GetTradeStatusStreamResponse class.
     *
     * @param  TradeStatusStreamRecord $tradeStatusStreamRecord Trade status record data.
     */
    final public function __construct(public TradeStatusStreamRecord $tradeStatusStreamRecord)
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
        return new static(new TradeStatusStreamRecord(...$response['data']));
    }
}
