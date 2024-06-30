<?php

namespace Timirey\XApi\Payloads;

/**
 * Class that contains payload for the getCurrentUserData command.
 */
class GetCurrentUserDataPayload extends AbstractPayload
{
    /**
     * @inheritdoc
     */
    public function getCommand(): string
    {
        return 'getCurrentUserData';
    }
}
