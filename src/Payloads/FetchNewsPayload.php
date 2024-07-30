<?php

namespace Timirey\XApi\Payloads;

use Override;

/**
 * Class representing the payload for the fetchNews stream command.
 */
final class FetchNewsPayload extends AbstractStreamPayload
{
    /**
     * @inheritdoc
     */
    #[Override]
    protected function getCommand(): string
    {
        return 'getNews';
    }
}
