<?php

use Timirey\XApi\Enums\Impact;
use Timirey\XApi\Payloads\GetCalendarPayload;
use Timirey\XApi\Responses\Data\CalendarRecord;
use Timirey\XApi\Responses\GetCalendarResponse;

test('getCalendar command', function () {
    $this->mockClient();

    $getCalendarPayload = new GetCalendarPayload();

    $mockGetCalendarResponse = [
        'status' => true,
        'returnData' => [
            [
                'country' => 'US',
                'current' => '',
                'forecast' => '3.5%',
                'impact' => Impact::MEDIUM,
                'period' => 'Q1 2021',
                'previous' => '3.2%',
                'time' => 1720170000000,
                'title' => 'GDP Growth Rate'
            ],
        ]
    ];

    $this->mockResponse($getCalendarPayload, $mockGetCalendarResponse);

    $getCalendarResponse = $this->client->getCalendar();

    expect($getCalendarResponse)->toBeInstanceOf(GetCalendarResponse::class)
        ->and($getCalendarResponse->calendarRecords[0])->toBeInstanceOf(CalendarRecord::class)
        ->and($getCalendarResponse->calendarRecords[0]->impact)->toBeInstanceOf(Impact::class);
});
