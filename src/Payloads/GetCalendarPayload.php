<?php

namespace Timirey\XApi\Payloads;

/**
 * Class that contains payload for the getCalendar command.
 */
class GetCalendarPayload extends AbstractPayload
{
    /**
     * @inheritdoc
     */
    public function getCommand(): string
    {
        return 'getCalendar';
    }
}
