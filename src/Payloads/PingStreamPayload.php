<?php

namespace Timirey\XApi\Payloads;

/**
 * Class representing the payload for the ping stream command.
 */
class PingStreamPayload extends AbstractStreamPayload
{
    /**
     * Returns the command name for the payload.
     *
     * @return string Command name.
     */
    public function getCommand(): string
    {
        return 'ping';
    }
}
