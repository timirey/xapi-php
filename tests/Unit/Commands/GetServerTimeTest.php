<?php

use Timirey\XApi\Payloads\GetServerTimePayload;
use Timirey\XApi\Responses\GetServerTimeResponse;

test('getServerTime command', function () {
    $this->mockClient();

    $getServerTimePayload = new GetServerTimePayload();

    $mockGetServerTimeResponse = [
        'status' => true,
        'returnData' => [
            'time' => 1392211379731,
            'timeString' => 'Feb 12, 2014 2:22:59 PM'
        ]
    ];

    $this->mockResponse($getServerTimePayload, $mockGetServerTimeResponse);

    $getServerTimeResponse = $this->client->getServerTime();

    expect($getServerTimeResponse)->toBeInstanceOf(GetServerTimeResponse::class)
        ->and($getServerTimeResponse->time)->toBeInstanceOf(DateTime::class);
});
