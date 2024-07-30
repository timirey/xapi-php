<?php

namespace Timirey\XApi\Payloads;

use Override;

/**
 * Class that contains payload for the getTrades command.
 */
final class GetTradesPayload extends AbstractPayload
{
    /**
     * Constructor for GetTradesPayload.
     *
     * @param  boolean $openedOnly If true then only opened trades will be returned.
     */
    public function __construct(bool $openedOnly)
    {
        $this->setParameter('openedOnly', $openedOnly);
    }

    /**
     * @inheritdoc
     */
    #[Override]
    protected function getCommand(): string
    {
        return 'getTrades';
    }
}
