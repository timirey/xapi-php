<?php

namespace Timirey\XApi\Payloads;

use Override;

/**
 * Class representing the payload for the fetchBalance stream command.
 */
final class FetchBalancePayload extends AbstractStreamPayload
{
    /**
     * @inheritdoc
     */
    #[Override]
    protected function getCommand(): string
    {
        return 'getBalance';
    }
}
