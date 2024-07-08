<?php

namespace Timirey\XApi\Payloads;

/**
 * Class that contains payload for the getCommissionDef command.
 */
class GetCommissionDefPayload extends AbstractPayload
{
    /**
     * Constructor for GetCommissionDefPayload.
     *
     * @param string $symbol Symbol.
     * @param float  $volume Volume.
     */
    public function __construct(string $symbol, float $volume)
    {
        $this->parameters['symbol'] = $symbol;
        $this->parameters['volume'] = $volume;
    }

    /**
     * Get the command.
     *
     * @return string Command name.
     */
    public function getCommand(): string
    {
        return 'getCommissionDef';
    }
}
