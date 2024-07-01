<?php

namespace Timirey\XApi\Payloads;

use DateTime;
use Timirey\XApi\Helpers\DateTimeHelper;

/**
 * Class that contains payload for the getIbsHistory command.
 */
class GetIbsHistoryPayload extends AbstractPayload
{
    /**
     * Constructor for GetIbsHistoryPayload.
     *
     * @param DateTime $start Start time in milliseconds since epoch.
     * @param DateTime $end End time in milliseconds since epoch.
     */
    public function __construct(DateTime $start, DateTime $end)
    {
        $this->arguments['start'] = DateTimeHelper::toMilliseconds($start);
        $this->arguments['end'] = DateTimeHelper::toMilliseconds($end);
    }

    /**
     * @inheritdoc
     */
    public function getCommand(): string
    {
        return 'getIbsHistory';
    }
}
