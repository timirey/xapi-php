<?php

namespace Timirey\XApi\Responses\Data;

/**
 * Class representing a news topic record.
 */
class NewsTopicRecord
{
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
        public int $time,
        public string $timeString,
        public string $title
    ) {
    }
}
