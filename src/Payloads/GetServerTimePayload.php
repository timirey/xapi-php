<?php

namespace Timirey\XApi\Payloads;

/**
 * Class that contains payload for the getServerTime command.
 */
class GetServerTimePayload extends AbstractPayload
{
    /**
     * @inheritdoc
     */
    public function getCommand(): string
    {
        return 'getServerTime';
    }
}
