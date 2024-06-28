<?php

namespace Timirey\XApi\Payloads;

/**
 * Class that contains payload for the getSymbol command.
 */
class GetSymbolPayload extends AbstractPayload
{
    /**
     * Constructor for GetSymbolPayload.
     *
     * @param string $symbol Symbol.
     */
    public function __construct(string $symbol)
    {
        $this->arguments['symbol'] = $symbol;
    }

    /**
     * @inheritdoc
     */
    public function getCommand(): string
    {
        return 'getSymbol';
    }
}
