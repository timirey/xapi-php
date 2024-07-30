<?php

namespace Timirey\XApi\Payloads;

use Override;

/**
 * Class representing the payload for the fetchCandles stream command.
 */
final class FetchCandlesPayload extends AbstractStreamPayload
{
    /**
     * Constructor for FetchCandlesPayload class.
     *
     * @param  string $streamSessionId Stream session ID.
     * @param  string $symbol          Symbol for which to get the candles.
     */
    public function __construct(string $streamSessionId, public string $symbol)
    {
        parent::__construct($streamSessionId);

        $this->setParameter('symbol', $this->symbol);
    }

    /**
     * @inheritdoc
     */
    #[Override]
    protected function getCommand(): string
    {
        return 'getCandles';
    }
}
