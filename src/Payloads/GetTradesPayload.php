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
     * @param boolean $openedOnly If true then only opened trades will be returned.
     */
    public function __construct(bool $openedOnly)
    {
        $this->arguments['openedOnly'] = $openedOnly;
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
