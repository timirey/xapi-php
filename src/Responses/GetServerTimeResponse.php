<?php

namespace Timirey\XApi\Responses;

use DateTime;
use Timirey\XApi\Helpers\DateTimeHelper;

/**
 * Class that contains the response of the getServerTime command.
 */
readonly class GetServerTimeResponse extends AbstractResponse
{
    /**
     * @var DateTime Time in date time.
     */
    public DateTime $time;

    /**
     * Constructor for GetServerTimeResponse.
     *
     * @param  integer $time       Time in date time in ms.
     * @param  string  $timeString Time described in form set on server (local time of server).
     */
    final public function __construct(int $time, public string $timeString)
    {
        $this->time = DateTimeHelper::fromMilliseconds($time);
    }
}
