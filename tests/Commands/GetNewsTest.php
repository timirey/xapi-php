<?php

use Timirey\XApi\Payloads\GetNewsPayload;
use Timirey\XApi\Responses\Data\NewsTopicRecord;
use Timirey\XApi\Responses\GetNewsResponse;
use Timirey\XApi\Tests\Commands\Traits\SocketClientMockeryTrait;

uses(SocketClientMockeryTrait::class);

beforeEach(function () {
    $this->mockClient();
});

afterEach(function () {
    Mockery::close();
});

test('getNews command', function (): void {
    $start = new DateTime('-1 month');
    $end = new DateTime();

    $payload = new GetNewsPayload($start, $end);

    $mockResponse = [
        'status' => true,
        'returnData' => [
            [
                'body' => '<html lang="">...</html>',
                'bodylen' => 110,
                'key' => '1f6da766abd29927aa854823f0105c23',
                'time' => 1262944112000,
                'timeString' => 'May 17, 2013 4:30:00 PM',
                'title' => 'Breaking trend',
            ],
        ],
    ];

    $this->mockResponse($payload, $mockResponse);

    $response = $this->client->getNews($start, $end);

    expect($response)->toBeInstanceOf(GetNewsResponse::class)
        ->and($response->newsTopicRecords[0])->toBeInstanceOf(NewsTopicRecord::class)
        ->and($response->newsTopicRecords[0]->time)->toBeInstanceOf(DateTime::class);
});
