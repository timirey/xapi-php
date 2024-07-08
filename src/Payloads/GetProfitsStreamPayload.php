<?php

namespace Timirey\XApi\Payloads;

/**
 * Class representing the payload for the getProfits stream command.
 */
class GetProfitsStreamPayload extends AbstractStreamPayload
{
    /**
     * Returns the command name for the payload.
     *
     * @return string Command name.
     */
    public function getCommand(): string
    {
        return 'getProfits';
    }
}
