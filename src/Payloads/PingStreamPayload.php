<?php

namespace Timirey\XApi\Payloads;

use Override;

/**
 * Class representing the payload for the ping stream command.
 */
final class PingStreamPayload extends AbstractStreamPayload
{
    /**
     * @inheritdoc
     */
    #[Override]
    protected function getCommand(): string
    {
        return 'ping';
    }
}
