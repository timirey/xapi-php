<?php

namespace Timirey\XApi\Payloads;

use Override;

/**
 * Class representing the payload for the fetchTickPrices stream command.
 */
final class FetchTickPricesPayload extends AbstractStreamPayload
{
    /**
     * Constructor for FetchTickPricesPayload class.
     *
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

        $this->setParameter('symbol', $this->symbol);

        if ($this->minArrivalTime !== null) {
            $this->setParameter('minArrivalTime', $this->minArrivalTime);
        }

        if ($this->maxLevel !== null) {
            $this->setParameter('maxLevel', $this->maxLevel);
        }
    }

    /**
     * @inheritdoc
     */
    #[Override]
    protected function getCommand(): string
    {
        return 'getTickPrices';
    }
}
