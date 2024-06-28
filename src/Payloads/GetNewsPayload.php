<?php

namespace Timirey\XApi\Payloads;

/**
 * Class that contains payload for the getNews command.
 */
class GetNewsPayload extends AbstractPayload
{
    /**
     * Constructor for GetNewsPayload.
     *
     * @param int $start Start time in milliseconds since epoch.
     * @param int $end End time in milliseconds since epoch.
     */
    public function __construct(
        int $start,
        int $end
    ) {
        $this->arguments['start'] = $start;
        $this->arguments['end'] = $end;
    }

    /**
     * @inheritdoc
     */
    public function getCommand(): string
    {
        return 'getNews';
    }
}
