<?php

namespace Timirey\XApi\Payloads;

/**
 * Class that contains payload for the getVersion command.
 */
class GetVersionPayload extends AbstractPayload
{
    /**
     * @inheritdoc
     */
    public function getCommand(): string
    {
        return 'getVersion';
    }
}
