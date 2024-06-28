<?php

namespace Timirey\XApi\Payloads;

/**
 * Class that contains payload for the ping command.
 */
class PingPayload extends AbstractPayload
{
    /**
     * @inheritdoc
     */
    public function getCommand(): string
    {
        return 'ping';
    }
}
