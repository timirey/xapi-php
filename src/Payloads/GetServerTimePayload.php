<?php

namespace Timirey\XApi\Payloads;

/**
 * Class that contains payload for the getServerTime command.
 */
class GetServerTimePayload extends AbstractPayload
{
    /**
     * Get the command.
     *
     * @return string Command name.
     */
    public function getCommand(): string
    {
        return 'getServerTime';
    }
}
