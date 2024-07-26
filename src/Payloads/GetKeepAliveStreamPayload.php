<?php

namespace Timirey\XApi\Payloads;

use Override;

/**
 * Class representing the payload for the getKeepAlive stream command.
 */
final class GetKeepAliveStreamPayload extends AbstractStreamPayload
{
    /**
     * Returns the command name for the payload.
     *
     * @return string Command name.
     */
    #[Override]
    protected function getCommand(): string
    {
        return 'getKeepAlive';
    }
}
