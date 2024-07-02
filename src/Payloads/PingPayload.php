<?php

namespace Timirey\XApi\Payloads;

/**
 * Class that contains payload for the ping command.
 */
class PingPayload extends AbstractPayload
{
    /**
     * Get the command.
     *
     * @return string Command name.
     */
    public function getCommand(): string
    {
        return 'ping';
    }
}
