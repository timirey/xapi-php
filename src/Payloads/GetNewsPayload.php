<?php

namespace Timirey\XApi\Payloads;

use DateTime;
use Timirey\XApi\Helpers\DateTimeHelper;

/**
 * Class that contains payload for the getNews command.
 */
class GetNewsPayload extends AbstractPayload
{
    /**
     * Constructor for GetNewsPayload.
     *
     * @param DateTime $start Start time in milliseconds since epoch.
     * @param DateTime $end   End time in milliseconds since epoch.
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
        return 'getNews';
    }
}
