<?php

namespace Timirey\XApi\Payloads;

use Timirey\XApi\Payloads\Data\TradeTransInfo;

/**
 * Class that contains payload for the tradeTransaction command.
 */
class TradeTransactionPayload extends AbstractPayload
{
    /**
     * Constructor for TradeTransactionPayload.
     *
     * @param TradeTransInfo $tradeTransInfo Transaction parameters.
     */
    public function __construct(TradeTransInfo $tradeTransInfo)
    {
        $this->arguments['tradeTransInfo'] = $tradeTransInfo;
    }

    /**
     * @inheritdoc
     */
    public function getCommand(): string
    {
        return 'tradeTransaction';
    }
}
