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
     * @param int $cmd Operation code.
     * @param float $openPrice Theoretical open price of order.
     * @param string $symbol Symbol.
     * @param float $volume Volume.
     */
    public function __construct(float $closePrice, int $cmd, float $openPrice, string $symbol, float $volume)
    {
        $this->arguments['closePrice'] = $closePrice;
        $this->arguments['cmd'] = Cmd::from($cmd);
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
