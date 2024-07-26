<?php

namespace Timirey\XApi\Payloads;

/**
 * Class representing the payload for the getTradeStatus stream command.
 */
final class GetTradeStatusStreamPayload extends AbstractStreamPayload
{
    /**
     * Returns the command name for the payload.
     *
     * @return string Command name.
     */
    public function getCommand(): string
    {
        return 'getTradeStatus';
    }
}
