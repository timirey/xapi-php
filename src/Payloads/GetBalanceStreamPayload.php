<?php

namespace Timirey\XApi\Payloads;

/**
 * Class representing the payload for the getBalance stream command.
 */
class GetBalanceStreamPayload extends AbstractStreamPayload
{
    /**
     * Returns the command name for the payload.
     *
     * @return string Command name.
     */
    public function getCommand(): string
    {
        return 'getBalance';
    }
}
