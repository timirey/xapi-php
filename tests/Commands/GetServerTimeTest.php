<?php

use Timirey\XApi\Payloads\GetServerTimePayload;
use Timirey\XApi\Responses\GetServerTimeResponse;
use Timirey\XApi\Tests\Commands\Traits\MockeryTrait;

uses(MockeryTrait::class);

beforeEach(function () {
    $this->mockClient();
});

test('getServerTime command', function () {
    $payload = new GetServerTimePayload();

    $mockResponse = [
        'status' => true,
        'returnData' => [
            'time' => 1392211379731,
            'timeString' => 'Feb 12, 2014 2:22:59 PM',
        ],
    ];

    $this->mockResponse($payload, $mockResponse);

    $response = $this->client->getServerTime();

    expect($response)->toBeInstanceOf(GetServerTimeResponse::class)
        ->and($response->time)->toBeInstanceOf(DateTime::class)
        ->and($response->timeString)->toBe('Feb 12, 2014 2:22:59 PM');
});
