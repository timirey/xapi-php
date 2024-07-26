<?php

namespace Timirey\XApi\Payloads;

use Override;

/**
 * Class that contains payload for the getMarginTrade command.
 */
final class GetMarginTradePayload extends AbstractPayload
{
    /**
     * Constructor for GetMarginTradePayload.
     *
     * @param  string $symbol Symbol.
     * @param  float  $volume Volume.
     */
    public function __construct(string $symbol, float $volume)
    {
        $this->parameters['symbol'] = $symbol;
        $this->parameters['volume'] = $volume;
    }

    /**
     * Get the command.
     *
     * @return string Command name.
     */
    #[Override]
    protected function getCommand(): string
    {
        return 'getMarginTrade';
    }
}
