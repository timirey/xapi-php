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
        $this->setParameter('order', $this->order);
    }

    /**
     * @inheritdoc
     */
    #[Override]
    protected function getCommand(): string
    {
        return 'tradeTransactionStatus';
    }
}
