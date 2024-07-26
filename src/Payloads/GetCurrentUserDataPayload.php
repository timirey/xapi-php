<?php

namespace Timirey\XApi\Payloads;

use Override;

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
    #[Override]
    protected function getCommand(): string
    {
        return 'getCurrentUserData';
    }
}
