<?php

namespace Timirey\XApi\Payloads;

use Override;

/**
 * Class that contains payload for the getAllSymbols command.
 */
final class GetAllSymbolsPayload extends AbstractPayload
{
    /**
     * @inheritdoc
     */
    #[Override]
    protected function getCommand(): string
    {
        return 'getAllSymbols';
    }
}
