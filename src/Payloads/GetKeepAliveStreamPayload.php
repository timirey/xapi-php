<?php

namespace Timirey\XApi\Payloads;

/**
 * Class representing the payload for the getKeepAlive stream command.
 */
class GetKeepAliveStreamPayload extends AbstractStreamPayload
{
    /**
     * Returns the command name for the payload.
     *
     * @return string Command name.
     */
    public function getCommand(): string
    {
        return 'getKeepAlive';
    }
}
