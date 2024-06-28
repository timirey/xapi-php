<?php

namespace Timirey\XApi\Payloads;

/**
 * Class that contains payload for the logout command.
 */
class LogoutPayload extends AbstractPayload
{
    /**
     * @inheritdoc
     */
    public function getCommand(): string
    {
        return 'logout';
    }
}
