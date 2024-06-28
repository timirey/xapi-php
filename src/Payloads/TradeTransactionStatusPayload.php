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
     * @param int $order Unique order number.
     */
    public function __construct(
        public int $order
    ) {
        $this->arguments['order'] = $order;
    }

    /**
     * @inheritdoc
     */
    public function getCommand(): string
    {
        return 'tradeTransactionStatus';
    }
}
