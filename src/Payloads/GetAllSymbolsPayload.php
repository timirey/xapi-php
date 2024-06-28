<?php

namespace Timirey\XApi\Payloads;

/**
 * Class that contains payload for the getAllSymbols command.
 */
class GetAllSymbolsPayload extends AbstractPayload
{
    /**
     * @inheritdoc
     */
    public function getCommand(): string
    {
        return 'getAllSymbols';
    }
}
