<?php

namespace Timirey\XApi\Responses\Data;

use DateTime;
use Timirey\XApi\Helpers\DateTimeHelper;

/**
 * Class representing a news topic record.
 */
class NewsTopicRecord
{
    /**
     * @var DateTime Time in date time.
     */
    public DateTime $time;

    /**
     * Constructor for NewsTopicRecord.
     *
     * @param string $body Body.
     * @param int $bodylen Body length.
     * @param string $key News key.
     * @param int $time Time in milliseconds since epoch.
     * @param string $timeString Time string.
     * @param string $title News title.
     */
    public function __construct(
        public string $body,
        public int $bodylen,
        public string $key,
        int $time,
        public string $timeString,
        public string $title
    ) {
        $this->time = DateTimeHelper::fromMilliseconds($time);
    }
}
