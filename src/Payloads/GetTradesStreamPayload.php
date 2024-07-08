<?php

namespace Timirey\XApi\Payloads;

/**
 * Class representing the payload for the getTrades stream command.
 */
class GetTradesStreamPayload extends AbstractStreamPayload
{
    /**
     * Returns the command name for the payload.
     *
     * @return string Command name.
     */
    public function getCommand(): string
    {
        return 'getTrades';
    }
}
