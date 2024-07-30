<?php

namespace Timirey\XApi\Payloads;

use Override;

/**
 * Class that contains payload for the getVersion command.
 */
final class GetVersionPayload extends AbstractPayload
{
    /**
     * @inheritdoc
     */
    #[Override]
    protected function getCommand(): string
    {
        return 'getVersion';
    }
}
