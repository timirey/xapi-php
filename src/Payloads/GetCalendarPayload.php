<?php

namespace Timirey\XApi\Payloads;

/**
 * Class that contains payload for the getCalendar command.
 */
final class GetCalendarPayload extends AbstractPayload
{
    /**
     * Get the command.
     *
     * @return string Command name.
     */
    public function getCommand(): string
    {
        return 'getCalendar';
    }
}
