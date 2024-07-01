<?php

namespace Timirey\XApi\Payloads;

use Timirey\XApi\Payloads\Enums\Level;

/**
 * Class that contains payload for the getTickPrices command.
 */
class GetTickPricesPayload extends AbstractPayload
{
    /**
     * Constructor for GetTickPricesPayload.
     *
     * @param Level $level Price level.
     * @param array $symbols Array of symbol names.
     * @param int $timestamp The time from which the most recent tick should be looked for.
     */
    public function __construct(Level $level, array $symbols, int $timestamp)
    {
        $this->arguments['level'] = $level->value;
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
