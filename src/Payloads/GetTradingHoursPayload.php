<?php

namespace Timirey\XApi\Payloads;

/**
 * Class that contains payload for the getTradingHours command.
 */
class GetTradingHoursPayload extends AbstractPayload
{
    /**
     * Constructor for GetTradingHoursPayload.
     *
     * @param array $symbols Array of symbol names.
     */
    public function __construct(array $symbols)
    {
        $this->arguments['symbols'] = $symbols;
    }

    /**
     * @inheritdoc
     */
    public function getCommand(): string
    {
        return 'getTradingHours';
    }
}