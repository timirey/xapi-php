<?php

namespace Timirey\XApi\Payloads;

/**
 * Class that contains payload for the getCurrentUserData command.
 */
final class GetCurrentUserDataPayload extends AbstractPayload
{
    /**
     * Get the command.
     *
     * @return string Command name.
     */
    public function getCommand(): string
    {
        return 'getCurrentUserData';
    }
}
