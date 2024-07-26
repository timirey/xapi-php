<?php

namespace Timirey\XApi\Payloads;

use DateTime;
use Override;
use Timirey\XApi\Enums\Level;
use Timirey\XApi\Helpers\DateTimeHelper;

/**
 * Class that contains payload for the getTickPrices command.
 */
final class GetTickPricesPayload extends AbstractPayload
{
    /**
     * Constructor for GetTickPricesPayload.
     *
     * @param  Level              $level     Price level.
     * @param array<int, string> $symbols   Array of symbol names.
     * @param  DateTime           $timestamp The time from which the most recent tick should be looked for.
     */
    public function __construct(Level $level, array $symbols, DateTime $timestamp)
    {
        $this->parameters['level'] = $level->value;
        $this->parameters['symbols'] = $symbols;
        $this->parameters['timestamp'] = DateTimeHelper::toMilliseconds($timestamp);
    }

    /**
     * Get the command.
     *
     * @return string Command name.
     */
    #[Override]
    protected function getCommand(): string
    {
        return 'getTickPrices';
    }
}
