<?php

namespace Timirey\XApi\Payloads;

use Override;

/**
 * Class representing the payload for the fetchProfits stream command.
 */
final class FetchProfitsPayload extends AbstractStreamPayload
{
    /**
     * @inheritdoc
     */
    #[Override]
    protected function getCommand(): string
    {
        return 'getProfits';
    }
}
