<?php

namespace Timirey\XApi\Payloads;

/**
 * Class that contains payload for the logout command.
 */
class LogoutPayload extends AbstractPayload
{
    /**
     * Get the command.
     *
     * @return string Command name.
     */
    public function getCommand(): string
    {
        return 'logout';
    }
}
