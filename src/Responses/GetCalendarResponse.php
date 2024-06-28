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
    public function __construct(public array $calendarRecords)
    {
    }

    /**
     * @inheritdoc
     */
    protected static function create(array $data): static
    {
        $returnData = $data['returnData'];

        $calendarRecords = [];

        foreach ($returnData as $calendarRecordData) {
            $calendarRecords[] = new CalendarRecord(...$calendarRecordData);
        }

        return new static($calendarRecords);
    }
}
