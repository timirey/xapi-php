<?php

namespace Timirey\XApi\Payloads;

use Override;

/**
 * Class that contains payload for the ping command.
 */
final class PingPayload extends AbstractPayload
{
    /**
     * Get the command.
     *
     * @return string Command name.
     */
    #[Override]
    public function getCommand(): string
    {
        return 'ping';
    }
}
