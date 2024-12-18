<?php

namespace Timirey\XApi\Payloads;

use Override;

/**
 * Class that contains payload for the getTradingHours command.
 */
final class GetTradingHoursPayload extends AbstractPayload
{
    /**
     * Constructor for GetTradingHoursPayload.
     *
     * @param array<int, string> $symbols Array of symbol names.
     */
    public function __construct(array $symbols)
    {
        $this->setParameter('symbols', $symbols);
    }

    /**
     * @inheritdoc
     */
    #[Override]
    protected function getCommand(): string
    {
        return 'getTradingHours';
    }
}
