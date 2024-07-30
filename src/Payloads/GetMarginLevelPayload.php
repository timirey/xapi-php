<?php

namespace Timirey\XApi\Payloads;

use Override;

/**
 * Class that contains payload for the getMarginLevel command.
 */
final class GetMarginLevelPayload extends AbstractPayload
{
    /**
     * @inheritdoc
     */
    #[Override]
    protected function getCommand(): string
    {
        return 'getMarginLevel';
    }
}
