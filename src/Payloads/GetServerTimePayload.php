<?php

namespace Timirey\XApi\Payloads;

use Override;

/**
 * Class that contains payload for the getServerTime command.
 */
final class GetServerTimePayload extends AbstractPayload
{
    /**
     * Get the command.
     *
     * @return string Command name.
     */
    #[Override]
    protected function getCommand(): string
    {
        return 'getServerTime';
    }
}
