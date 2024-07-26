<?php

namespace Timirey\XApi\Payloads;

use Override;

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
    #[Override]
    public function getCommand(): string
    {
        return 'getAllSymbols';
    }
}
