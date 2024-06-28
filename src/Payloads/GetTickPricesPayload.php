<?php

namespace Timirey\XApi\Payloads;

/**
 * Class that contains payload for the getTickPrices command.
 */
class GetTickPricesPayload extends AbstractPayload
{
    /**
     * Constructor for GetTickPricesPayload.
     *
     * @param int $level Price level.
     * @param array $symbols Array of symbol names.
     * @param int $timestamp The time from which the most recent tick should be looked for.
     */
    public function __construct(
        int $level,
        array $symbols,
        int $timestamp
    ) {
        $this->arguments['level'] = $level;
        $this->arguments['symbols'] = $symbols;
        $this->arguments['timestamp'] = $timestamp;
    }

    /**
     * @inheritdoc
     */
    public function getCommand(): string
    {
        return 'getTickPrices';
    }
}
