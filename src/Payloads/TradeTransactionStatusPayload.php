<?php

namespace Timirey\XApi\Payloads;

/**
 * Class that contains payload for the tradeTransactionStatus command.
 */
class TradeTransactionStatusPayload extends AbstractPayload
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
    public function getCommand(): string
    {
        return 'tradeTransactionStatus';
    }
}
