<?php

namespace Timirey\XApi\Payloads;

/**
 * Class representing the payload for the getCandles stream command.
 */
final class GetCandlesStreamPayload extends AbstractStreamPayload
{
    /**
     * @param  string $streamSessionId Stream session ID.
     * @param  string $symbol          Symbol for which to get the candles.
     */
    public function __construct(string $streamSessionId, public string $symbol)
    {
        parent::__construct($streamSessionId);

        $this->parameters['symbol'] = $this->symbol;
    }

    /**
     * Returns the command name for the payload.
     *
     * @return string Command name.
     */
    public function getCommand(): string
    {
        return 'getCandles';
    }
}
