<?php

namespace Timirey\XApi\Payloads;

use Override;

/**
 * Class that contains payload for the getSymbol command.
 */
final class GetSymbolPayload extends AbstractPayload
{
    /**
     * Constructor for GetSymbolPayload.
     *
     * @param  string $symbol Symbol.
     */
    public function __construct(string $symbol)
    {
        $this->parameters['symbol'] = $symbol;
    }

    /**
     * Get the command.
     *
     * @return string Command name.
     */
    #[Override]
    public function getCommand(): string
    {
        return 'getSymbol';
    }
}
