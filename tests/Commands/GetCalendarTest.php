<?php

use Timirey\XApi\Enums\Impact;
use Timirey\XApi\Payloads\GetCalendarPayload;
use Timirey\XApi\Responses\Data\CalendarRecord;
use Timirey\XApi\Responses\GetCalendarResponse;
use Timirey\XApi\Tests\Commands\Traits\ClientMockeryTrait;

uses(ClientMockeryTrait::class);

beforeEach(function () {
    $this->mockClient();
});

afterEach(function () {
    Mockery::close();
});

test('getCalendar command', function () {
    $payload = new GetCalendarPayload();
    $mockResponse = [
        'status' => true,
        'returnData' => [
            [
                'country' => 'US',
                'current' => '',
                'forecast' => '3.5%',
                'impact' => '2',
                'period' => 'Q1 2021',
                'previous' => '3.2%',
                'time' => 1720170000000,
                'title' => 'GDP Growth Rate',
            ],
        ],
    ];

    $this->mockResponse($payload, $mockResponse);

    $response = $this->client->getCalendar();

    expect($response)->toBeInstanceOf(GetCalendarResponse::class)
        ->and($response->calendarRecords[0])->toBeInstanceOf(CalendarRecord::class)
        ->and($response->calendarRecords[0]->impact)->toBeInstanceOf(Impact::class)
        ->and($response->calendarRecords[0]->time)->toBeInstanceOf(DateTime::class);
});
