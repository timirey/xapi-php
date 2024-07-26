<?php

namespace Timirey\XApi\Payloads;

use Override;

/**
 * Class representing the payload for the getProfits stream command.
 */
final class GetProfitsStreamPayload extends AbstractStreamPayload
{
    /**
     * Returns the command name for the payload.
     *
     * @return string Command name.
     */
    #[Override]
    protected function getCommand(): string
    {
        return 'getProfits';
    }
}
