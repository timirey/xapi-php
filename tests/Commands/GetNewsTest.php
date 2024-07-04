<?php

use Timirey\XApi\Payloads\GetNewsPayload;
use Timirey\XApi\Responses\Data\NewsTopicRecord;
use Timirey\XApi\Responses\GetNewsResponse;
use Timirey\XApi\Tests\Commands\Traits\MockeryTrait;

uses(MockeryTrait::class);

beforeEach(function () {
    $this->mockClient();
});

test('getNews command', function () {
    $payload = new GetNewsPayload(new DateTime('-1 month'), new DateTime());

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

    $response = $this->client->getNews(new DateTime('-1 month'), new DateTime());

    expect($response)->toBeInstanceOf(GetNewsResponse::class)
        ->and($response->newsTopicRecords[0])->toBeInstanceOf(NewsTopicRecord::class)
        ->and($response->newsTopicRecords[0]->time)->toBeInstanceOf(DateTime::class);
});
