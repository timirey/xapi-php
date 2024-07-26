<?php

namespace Timirey\XApi\Payloads;

/**
 * Class representing the payload for the getTickPrices stream command.
 */
final class GetTickPricesStreamPayload extends AbstractStreamPayload
{
    /**
     * @param  string       $streamSessionId Stream session ID.
     * @param  string       $symbol          Symbol for which to get the tick prices.
     * @param  integer|null $minArrivalTime  Minimal interval in milliseconds between updates (optional).
     * @param  integer|null $maxLevel        Maximum level of the quote (optional).
     */
    public function __construct(
        string $streamSessionId,
        public string $symbol,
        public ?int $minArrivalTime = null,
        public ?int $maxLevel = null
    ) {
        parent::__construct($streamSessionId);

        $this->parameters['symbol'] = $this->symbol;

        if ($this->minArrivalTime !== null) {
            $this->parameters['minArrivalTime'] = $this->minArrivalTime;
        }

        if ($this->maxLevel !== null) {
            $this->parameters['maxLevel'] = $this->maxLevel;
        }
    }

    /**
     * Returns the command name for the payload.
     *
     * @return string Command name.
     */
    public function getCommand(): string
    {
        return 'getTickPrices';
    }
}
