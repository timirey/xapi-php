<?php

namespace Timirey\XApi\Payloads;

use Override;

/**
 * Class that contains payload for the getCommissionDef command.
 */
final class GetCommissionDefPayload extends AbstractPayload
{
    /**
     * Constructor for GetCommissionDefPayload.
     *
     * @param  string $symbol Symbol.
     * @param  float  $volume Volume.
     */
    public function __construct(string $symbol, float $volume)
    {
        $this->setParameters([
            'symbol' => $symbol,
            'volume' => $volume
        ]);
    }

    /**
     * Get the command.
     *
     * @return string Command name.
     */
    #[Override]
    protected function getCommand(): string
    {
        return 'getCommissionDef';
    }
}
