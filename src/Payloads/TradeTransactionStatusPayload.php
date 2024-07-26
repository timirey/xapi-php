<?php

namespace Timirey\XApi\Payloads;

use Override;

/**
 * Class that contains payload for the tradeTransactionStatus command.
 */
final class TradeTransactionStatusPayload extends AbstractPayload
{
    /**
     * Constructor for TradeTransactionStatusPayload.
     *
     * @param  integer $order Unique order number.
     */
    public function __construct(public int $order)
    {
        $this->parameters['order'] = $order;
    }

    /**
     * Get the command.
     *
     * @return string Command name.
     */
    #[Override]
    protected function getCommand(): string
    {
        return 'tradeTransactionStatus';
    }
}
