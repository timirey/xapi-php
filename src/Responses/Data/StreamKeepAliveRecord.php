<?php

namespace Timirey\XApi\Responses\Data;

use DateTime;
use Timirey\XApi\Helpers\DateTimeHelper;

/**
 * Class representing the keep alive record data in the streaming response.
 */
class StreamKeepAliveRecord
{
    /**
     * @var DateTime Timestamp.
     */
    public DateTime $timestamp;

    /**
     * Constructor for the StreamKeepAliveRecord class.
     *
     * @param int $timestamp Current timestamp.
     */
    public function __construct(int $timestamp)
    {
        $this->timestamp = DateTimeHelper::fromMilliseconds($timestamp);
    }
}
