<?php

namespace Timirey\XApi\Payloads;

/**
 * Class that contains payload for the getTradeRecords command.
 */
class GetTradeRecordsPayload extends AbstractPayload
{
    /**
     * Constructor for GetTradeRecordsPayload.
     *
     * @param array $orders Array of orders (position numbers).
     */
    public function __construct(array $orders)
    {
        $this->arguments['orders'] = $orders;
    }

    /**
     * @inheritdoc
     */
    public function getCommand(): string
    {
        return 'getTradeRecords';
    }
}
