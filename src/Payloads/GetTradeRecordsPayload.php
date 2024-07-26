<?php

namespace Timirey\XApi\Payloads;

use Override;

/**
 * Class that contains payload for the getTradeRecords command.
 */
final class GetTradeRecordsPayload extends AbstractPayload
{
    /**
     * Constructor for GetTradeRecordsPayload.
     *
     * @param  array<int, int> $orders Array of orders (position numbers).
     */
    public function __construct(array $orders)
    {
        $this->parameters['orders'] = $orders;
    }

    /**
     * Get the command.
     *
     * @return string Command name.
     */
    #[Override]
    protected function getCommand(): string
    {
        return 'getTradeRecords';
    }
}
