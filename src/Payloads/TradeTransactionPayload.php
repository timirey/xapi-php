<?php

namespace Timirey\XApi\Payloads;

use Override;
use Timirey\XApi\Payloads\Data\TradeTransInfo;

/**
 * Class that contains payload for the tradeTransaction command.
 */
final class TradeTransactionPayload extends AbstractPayload
{
    /**
     * Constructor for TradeTransactionPayload.
     *
     * @param  TradeTransInfo $tradeTransInfo Transaction parameters.
     */
    public function __construct(TradeTransInfo $tradeTransInfo)
    {
        $this->setParameter('tradeTransInfo', $tradeTransInfo);
    }

    /**
     * @inheritdoc
     */
    #[Override]
    protected function getCommand(): string
    {
        return 'tradeTransaction';
    }
}
