<?php

namespace Timirey\XApi\Payloads;

use Override;

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
    #[Override]
    protected function getCommand(): string
    {
        return 'getCalendar';
    }
}
