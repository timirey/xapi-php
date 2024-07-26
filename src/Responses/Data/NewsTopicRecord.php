<?php

namespace Timirey\XApi\Responses\Data;

use DateTime;
use Timirey\XApi\Helpers\DateTimeHelper;

/**
 * Class representing a news topic record.
 */
readonly class NewsTopicRecord
{
    /**
     * @var DateTime Time in date time.
     */
    public DateTime $time;

    /**
     * @var integer Body length.
     */
    public int $bodyLen;

    /**
     * Constructor for NewsTopicRecord.
     *
     * @param  string  $body       Body.
     * @param  integer $bodylen    Body length.
     * @param  string  $key        News key.
     * @param  integer $time       Time in milliseconds since epoch.
     * @param  string  $timeString Time string.
     * @param  string  $title      News title.
     */
    final public function __construct(
        public string $body,
        int $bodylen,
        public string $key,
        int $time,
        public string $timeString,
        public string $title
    ) {
        $this->time = DateTimeHelper::fromMilliseconds($time);

        $this->bodyLen = $bodylen;
    }
}
