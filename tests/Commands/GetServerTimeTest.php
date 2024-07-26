<?php

use Timirey\XApi\Payloads\GetServerTimePayload;
use Timirey\XApi\Responses\GetServerTimeResponse;
use Timirey\XApi\Tests\Commands\Traits\SocketClientMockeryTrait;

uses(SocketClientMockeryTrait::class);

beforeEach(function () {
    $this->mockClient();
});

afterEach(function () {
    Mockery::close();
});

test('getServerTime command', function (): void {
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
        ->and($response->time)->toBeInstanceOf(DateTime::class);
});
