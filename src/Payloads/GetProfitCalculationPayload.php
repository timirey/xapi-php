<?php

namespace Timirey\XApi\Payloads;

use Timirey\XApi\Enums\Cmd;

/**
 * Class that contains payload for the getProfitCalculation command.
 */
class GetProfitCalculationPayload extends AbstractPayload
{
    /**
     * Constructor for GetProfitCalculationPayload.
     *
     * @param float $closePrice Theoretical close price of order.
     * @param Cmd $cmd Operation code.
     * @param float $openPrice Theoretical open price of order.
     * @param string $symbol Symbol.
     * @param float $volume Volume.
     */
    public function __construct(float $closePrice, Cmd $cmd, float $openPrice, string $symbol, float $volume)
    {
        $this->arguments['closePrice'] = $closePrice;
        $this->arguments['cmd'] = $cmd->value;
        $this->arguments['openPrice'] = $openPrice;
        $this->arguments['symbol'] = $symbol;
        $this->arguments['volume'] = $volume;
    }

    /**
     * @inheritdoc
     */
    public function getCommand(): string
    {
        return 'getProfitCalculation';
    }
}
