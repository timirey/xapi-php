<?php

use Timirey\XApi\Payloads\GetNewsPayload;
use Timirey\XApi\Responses\Data\NewsTopicRecord;
use Timirey\XApi\Responses\GetNewsResponse;

test('getNews command', function () {
    $this->mockClient();

    $getNewsPayload = new GetNewsPayload(new DateTime('-1 month'), new DateTime());

    $mockGetNewsResponse = [
        'status' => true,
        'returnData' => [
            [
                'body' => '<html lang="">...</html>',
                'bodylen' => 110,
                'key' => '1f6da766abd29927aa854823f0105c23',
                'time' => 1262944112000,
                'timeString' => 'May 17, 2013 4:30:00 PM',
                'title' => 'Breaking trend'
            ],
        ]
    ];

    $this->mockResponse($getNewsPayload, $mockGetNewsResponse);

    $getNewsResponse = $this->client->getNews(new DateTime('-1 month'), new DateTime());

    expect($getNewsResponse)->toBeInstanceOf(GetNewsResponse::class)
        ->and($getNewsResponse->newsTopicRecords[0])->toBeInstanceOf(NewsTopicRecord::class)
        ->and($getNewsResponse->newsTopicRecords[0]->time)->toBeInstanceOf(DateTime::class);
});
