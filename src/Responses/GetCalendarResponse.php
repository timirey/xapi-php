<?php

namespace Timirey\XApi\Responses;

use Timirey\XApi\Responses\Data\CalendarRecord;
use Timirey\XApi\Responses\Data\SymbolRecord;

/**
 * Class that contains the response of the getCalendar command.
 */
class GetCalendarResponse extends AbstractResponse
{
    /**
     * Constructor for GetCalendarResponse.
     *
     * @param CalendarRecord[] $calendarRecords
     */
    public function __construct(
        public array $calendarRecords
    ) {
    }

    /**
     * @inheritdoc
     */
    protected static function create(array $data): static
    {
        return new static(
            calendarRecords: array_map(
                static fn(array $calendarRecordData): CalendarRecord => new CalendarRecord(...$calendarRecordData),
                $data['returnData']
            )
        );
    }
}
