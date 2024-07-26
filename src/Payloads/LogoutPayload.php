<?php

namespace Timirey\XApi\Payloads;

use Override;

/**
 * Class that contains payload for the logout command.
 */
final class LogoutPayload extends AbstractPayload
{
    /**
     * Get the command.
     *
     * @return string Command name.
     */
    #[Override]
    protected function getCommand(): string
    {
        return 'logout';
    }
}
