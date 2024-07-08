<?php

namespace Timirey\XApi\Responses\Data;

use DateTime;
use Timirey\XApi\Helpers\DateTimeHelper;

/**
 * Class representing the news record data in the streaming response.
 */
class StreamNewsRecord
{
    /**
     * @var DateTime Timestamp.
     */
    public DateTime $time;

    /**
     * Constructor for the StreamNewsRecord class.
     *
     * @param string $body  Body of the news.
     * @param string $key   News key.
     * @param int    $time  Time of the news.
     * @param string $title Title of the news.
     */
    public function __construct(
        public string $body,
        public string $key,
        int $time,
        public string $title
    ) {
        $this->time = DateTimeHelper::fromMilliseconds($time);
    }
}
