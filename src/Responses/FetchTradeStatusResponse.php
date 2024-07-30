<?php

namespace Timirey\XApi\Responses;

use Override;
use Timirey\XApi\Responses\Data\TradeStatusStreamRecord;

/**
 * Class that contains the response of the fetchTradeStatus stream command.
 */
final readonly class FetchTradeStatusResponse extends AbstractStreamResponse
{
    /**
     * Constructor for the FetchTradeStatusResponse class.
     *
     * @param  TradeStatusStreamRecord $tradeStatusStreamRecord Trade status record data.
     */
    public function __construct(public TradeStatusStreamRecord $tradeStatusStreamRecord)
    {
    }

    /**
     * @inheritdoc
     */
    #[Override]
    protected static function create(array $response): self
    {
        return new self(new TradeStatusStreamRecord(...$response));
    }
}
