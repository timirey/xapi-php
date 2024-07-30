<?php

namespace Timirey\XApi\Responses;

use Override;
use Timirey\XApi\Responses\Data\CandleStreamRecord;

/**
 * Class that contains the response of the fetchCandles stream command.
 */
final readonly class FetchCandlesResponse extends AbstractStreamResponse
{
    /**
     * Constructor for the FetchCandlesResponse class.
     *
     * @param  CandleStreamRecord $candleStreamRecord Candle record data.
     */
    public function __construct(public CandleStreamRecord $candleStreamRecord)
    {
    }

    /**
     * @inheritdoc
     */
    #[Override]
    protected static function create(array $response): self
    {
        return new self(new CandleStreamRecord(...$response));
    }
}
