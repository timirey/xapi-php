<?php

namespace Timirey\XApi\Payloads;

use Override;

/**
 * Class representing the payload for the getNews stream command.
 */
final class GetNewsStreamPayload extends AbstractStreamPayload
{
    /**
     * Returns the command name for the payload.
     *
     * @return string Command name.
     */
    #[Override]
    protected function getCommand(): string
    {
        return 'getNews';
    }
}
