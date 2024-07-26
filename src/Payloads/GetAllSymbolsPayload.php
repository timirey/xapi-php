<?php

namespace Timirey\XApi\Payloads;

/**
 * Class that contains payload for the getAllSymbols command.
 */
final class GetAllSymbolsPayload extends AbstractPayload
{
    /**
     * Get the command.
     *
     * @return string Command name.
     */
    public function getCommand(): string
    {
        return 'getAllSymbols';
    }
}
