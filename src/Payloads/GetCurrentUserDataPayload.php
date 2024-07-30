<?php

namespace Timirey\XApi\Payloads;

use Override;

/**
 * Class that contains payload for the getCurrentUserData command.
 */
final class GetCurrentUserDataPayload extends AbstractPayload
{
    /**
     * @inheritdoc
     */
    #[Override]
    protected function getCommand(): string
    {
        return 'getCurrentUserData';
    }
}
