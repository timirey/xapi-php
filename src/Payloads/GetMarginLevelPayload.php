<?php

namespace Timirey\XApi\Payloads;

use Override;

/**
 * Class that contains payload for the getMarginLevel command.
 */
final class GetMarginLevelPayload extends AbstractPayload
{
    /**
     * Get the command.
     *
     * @return string Command name.
     */
    #[Override]
    public function getCommand(): string
    {
        return 'getMarginLevel';
    }
}
