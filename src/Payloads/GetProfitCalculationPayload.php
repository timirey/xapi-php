<?php

namespace Timirey\XApi\Payloads;

use Override;
use Timirey\XApi\Enums\Cmd;

/**
 * Class that contains payload for the getProfitCalculation command.
 */
final class GetProfitCalculationPayload extends AbstractPayload
{
    /**
     * Constructor for GetProfitCalculationPayload.
     *
     * @param  float  $closePrice Theoretical close price of order.
     * @param  Cmd    $cmd        Operation code.
     * @param  float  $openPrice  Theoretical open price of order.
     * @param  string $symbol     Symbol.
     * @param  float  $volume     Volume.
     */
    public function __construct(float $closePrice, Cmd $cmd, float $openPrice, string $symbol, float $volume)
    {
        $this->parameters['closePrice'] = $closePrice;
        $this->parameters['cmd'] = $cmd->value;
        $this->parameters['openPrice'] = $openPrice;
        $this->parameters['symbol'] = $symbol;
        $this->parameters['volume'] = $volume;
    }

    /**
     * Get the command.
     *
     * @return string Command name.
     */
    #[Override]
    protected function getCommand(): string
    {
        return 'getProfitCalculation';
    }
}
