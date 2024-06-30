<?php

namespace Timirey\XApi\Payloads;

/**
 * Class that contains payload for the getTradesHistory command.
 */
class GetTradesHistoryPayload extends AbstractPayload
{
    /**
     * Constructor for GetTradesHistoryPayload.
     *
     * @param int $start Start time for trade history retrieval (milliseconds since epoch).
     * @param int $end End time for trade history retrieval (milliseconds since epoch).
     */
    public function __construct(int $start, int $end)
    {
        $this->arguments['start'] = $start;
        $this->arguments['end'] = $end;
    }

    /**
     * @inheritdoc
     */
    public function getCommand(): string
    {
        return 'getTradesHistory';
    }
}
