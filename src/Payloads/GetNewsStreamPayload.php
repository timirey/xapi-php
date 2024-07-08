<?php

namespace Timirey\XApi\Payloads;

/**
 * Class representing the payload for the getNews stream command.
 */
class GetNewsStreamPayload extends AbstractStreamPayload
{
    /**
     * @param string $streamSessionId Stream session ID.
     */
    public function __construct(string $streamSessionId)
    {
        parent::__construct($streamSessionId);
    }

    /**
     * Returns the command name for the payload.
     *
     * @return string Command name.
     */
    public function getCommand(): string
    {
        return 'getNews';
    }
}
