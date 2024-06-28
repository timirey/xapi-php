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
     * @param float $volume Volume.
     */
    public function __construct(string $symbol, float $volume)
    {
        $this->arguments['symbol'] = $symbol;
        $this->arguments['volume'] = $volume;
    }

    /**
     * @inheritdoc
     */
    public function getCommand(): string
    {
        return 'getCommissionDef';
    }
}
