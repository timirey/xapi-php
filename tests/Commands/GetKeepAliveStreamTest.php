<?php

use Timirey\XApi\Payloads\GetKeepAliveStreamPayload;
use Timirey\XApi\Responses\GetKeepAliveStreamResponse;
use Timirey\XApi\Tests\Commands\Traits\StreamClientMockeryTrait;

uses(StreamClientMockeryTrait::class);

beforeEach(function () {
    $this->mockStreamClient();
});

afterEach(function () {
    Mockery::close();
});

test('getKeepAlive stream command', function () {
    $payload = new GetKeepAliveStreamPayload('streamSessionId');
    $mockResponse = [
        'command' => 'keepAlive',
        'data' => [
            'timestamp' => 1362944112000,
        ],
    ];

    $this->mockStreamResponse($payload, $mockResponse);

    $client = $this->client;

    $client->getKeepAlive(function (GetKeepAliveStreamResponse $response) use ($client) {
        expect($response)->toBeInstanceOf(GetKeepAliveStreamResponse::class)
            ->and($response->streamKeepAliveRecord->timestamp)->toBeInstanceOf(DateTime::class);

        $client->unsubscribe();
    });
});
