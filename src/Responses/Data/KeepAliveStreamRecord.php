<?php

namespace Timirey\XApi\Responses\Data;

use DateTime;
use Timirey\XApi\Helpers\DateTimeHelper;

/**
 * Class representing the keep alive record data in the streaming response.
 */
final readonly class KeepAliveStreamRecord
{
    /**
     * @var DateTime Timestamp.
     */
    public DateTime $timestamp;

    /**
     * Constructor for the KeepAliveStreamRecord class.
     *
     * @param  integer $timestamp Current timestamp.
     */
    public function __construct(int $timestamp)
    {
        $this->timestamp = DateTimeHelper::fromMilliseconds($timestamp);
    }
}
