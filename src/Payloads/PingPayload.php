<?php

namespace Timirey\XApi\Payloads;

use Override;

/**
 * Class that contains payload for the ping command.
 */
final class PingPayload extends AbstractPayload
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
