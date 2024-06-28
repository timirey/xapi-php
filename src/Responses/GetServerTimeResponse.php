<?php

namespace Timirey\XApi\Responses;

/**
 * Class that contains the response of the getServerTime command.
 */
class GetServerTimeResponse extends AbstractResponse
{
    /**
     * Constructor for GetServerTimeResponse.
     *
     * @param int $time Time in milliseconds since epoch.
     * @param string $timeString Time described in form set on server (local time of server).
     */
    public function __construct(public int $time, public string $timeString)
    {
    }
}
