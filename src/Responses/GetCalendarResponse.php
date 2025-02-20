<?php

namespace Timirey\XApi\Responses;

use Override;
use Timirey\XApi\Responses\Data\CalendarRecord;

/**
 * Class that contains the response of the getCalendar command.
 */
final readonly class GetCalendarResponse extends AbstractResponse
{
    /**
     * Constructor for GetCalendarResponse.
     *
     * @param  CalendarRecord[] $calendarRecords CalendarRecord instances.
     */
    public function __construct(public array $calendarRecords)
    {
    }

    /**
     * @inheritdoc
     */
    #[Override]
    protected static function create(array $response): self
    {
        return new self(array_map(
            static fn (array $calendarRecordData): CalendarRecord => new CalendarRecord(...$calendarRecordData),
            $response
        ));
    }
}
