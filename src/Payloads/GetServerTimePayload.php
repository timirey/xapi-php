<?php

namespace Timirey\XApi\Payloads;

use Override;

/**
 * Class that contains payload for the getServerTime command.
 */
final class GetServerTimePayload extends AbstractPayload
{
    /**
     * @inheritdoc
     */
    #[Override]
    protected function getCommand(): string
    {
        return 'getServerTime';
    }
}
