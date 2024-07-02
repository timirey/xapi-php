<?php

namespace Timirey\XApi\Payloads;

/**
 * Class that contains payload for the getVersion command.
 */
class GetVersionPayload extends AbstractPayload
{
    /**
     * Get the command.
     *
     * @return string Command name.
     */
    public function getCommand(): string
    {
        return 'getVersion';
    }
}
