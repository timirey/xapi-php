<?php

namespace Timirey\XApi\Payloads;

use Override;

/**
 * Class representing the payload for the getTrades stream command.
 */
final class GetTradesStreamPayload extends AbstractStreamPayload
{
    /**
     * Returns the command name for the payload.
     *
     * @return string Command name.
     */
    #[Override]
    public function getCommand(): string
    {
        return 'getTrades';
    }
}
