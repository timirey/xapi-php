<?php

namespace Timirey\XApi\Responses;

use Override;
use Timirey\XApi\Responses\Data\TradeStreamRecord;

/**
 * Class that contains the response of the fetchTrades stream command.
 */
final readonly class FetchTradesResponse extends AbstractStreamResponse
{
    /**
     * Constructor for the FetchTradesResponse class.
     *
     * @param  TradeStreamRecord $tradeStreamRecord Trade record data.
     */
    public function __construct(public TradeStreamRecord $tradeStreamRecord)
    {
    }

    /**
     * @inheritdoc
     */
    #[Override]
    protected static function create(array $response): self
    {
        return new self(new TradeStreamRecord(...$response));
    }
}
