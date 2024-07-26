<?php

namespace Timirey\XApi\Responses;

use Timirey\XApi\Responses\Data\TradeStatusStreamRecord;

/**
 * Class that contains the response of the getTradeStatus stream command.
 */
final readonly class GetTradeStatusStreamResponse extends AbstractStreamResponse
{
    /**
     * Constructor for the GetTradeStatusStreamResponse class.
     *
     * @param  TradeStatusStreamRecord $tradeStatusStreamRecord Trade status record data.
     */
    public function __construct(public TradeStatusStreamRecord $tradeStatusStreamRecord)
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
        return new self(new TradeStatusStreamRecord(...$response['data']));
    }
}
