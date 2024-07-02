<?php

namespace Timirey\XApi\Payloads;

use DateTime;
use Timirey\XApi\Helpers\DateTimeHelper;

/**
 * Class that contains payload for the getTradesHistory command.
 */
class GetTradesHistoryPayload extends AbstractPayload
{
    /**
     * Constructor for GetTradesHistoryPayload.
     *
     * @param DateTime $start Start time for trade history retrieval.
     * @param DateTime $end   End time for trade history retrieval.
     */
    public function __construct(DateTime $start, DateTime $end)
    {
        $this->arguments['start'] = DateTimeHelper::toMilliseconds($start);
        $this->arguments['end'] = DateTimeHelper::toMilliseconds($end);
    }

    /**
     * Get the command.
     *
     * @return string Command name.
     */
    public function getCommand(): string
    {
        return 'getTradesHistory';
    }
}
