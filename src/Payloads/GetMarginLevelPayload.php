<?php

namespace Timirey\XApi\Payloads;

/**
 * Class that contains payload for the getMarginLevel command.
 */
class GetMarginLevelPayload extends AbstractPayload
{
    /**
     * Get the command.
     *
     * @return string Command name.
     */
    public function getCommand(): string
    {
        return 'getMarginLevel';
    }
}
