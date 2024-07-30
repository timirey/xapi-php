<?php

namespace Timirey\XApi\Payloads;

use Override;

/**
 * Class representing the payload for the fetchKeepAlive stream command.
 */
final class FetchKeepAlivePayload extends AbstractStreamPayload
{
    /**
     * @inheritdoc
     */
    #[Override]
    protected function getCommand(): string
    {
        return 'getKeepAlive';
    }
}
