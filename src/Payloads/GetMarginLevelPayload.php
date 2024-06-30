<?php

namespace Timirey\XApi\Payloads;

/**
 * Class that contains payload for the getMarginLevel command.
 */
class GetMarginLevelPayload extends AbstractPayload
{
    /**
     * @inheritdoc
     */
    public function getCommand(): string
    {
        return 'getMarginLevel';
    }
}
