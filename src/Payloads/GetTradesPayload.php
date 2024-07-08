<?php

namespace Timirey\XApi\Payloads;

/**
 * Class that contains payload for the getTrades command.
 */
class GetTradesPayload extends AbstractPayload
{
    /**
     * Constructor for GetTradesPayload.
     *
     * @param bool $openedOnly If true then only opened trades will be returned.
     */
    public function __construct(bool $openedOnly)
    {
        $this->parameters['openedOnly'] = $openedOnly;
    }

    /**
     * Get the command.
     *
     * @return string Command name.
     */
    public function getCommand(): string
    {
        return 'getTrades';
    }
}
