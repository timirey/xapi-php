<?php

namespace Timirey\XApi\Payloads;

use Override;

/**
 * Class representing the payload for the fetchTradeStatus stream command.
 */
final class FetchTradeStatusPayload extends AbstractStreamPayload
{
    /**
     * @inheritdoc
     */
    #[Override]
    protected function getCommand(): string
    {
        return 'getTradeStatus';
    }
}
