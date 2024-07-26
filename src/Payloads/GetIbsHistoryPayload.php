<?php

namespace Timirey\XApi\Payloads;

use DateTime;
use Timirey\XApi\Helpers\DateTimeHelper;

/**
 * Class that contains payload for the getIbsHistory command.
 */
final class GetIbsHistoryPayload extends AbstractPayload
{
    /**
     * Constructor for GetIbsHistoryPayload.
     *
     * @param  DateTime $start Start time in milliseconds since epoch.
     * @param  DateTime $end   End time in milliseconds since epoch.
     */
    public function __construct(DateTime $start, DateTime $end)
    {
        $this->parameters['start'] = DateTimeHelper::toMilliseconds($start);
        $this->parameters['end'] = DateTimeHelper::toMilliseconds($end);
    }

    /**
     * Get the command.
     *
     * @return string Command name.
     */
    public function getCommand(): string
    {
        return 'getIbsHistory';
    }
}
