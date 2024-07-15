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
        'data' => ['timestamp' => 1362944112000],
    ];

    $this->mockStreamResponse($payload, $mockResponse);

    $streamClient = $this->streamClient;

    $streamClient->getKeepAlive(function (GetKeepAliveStreamResponse $response) {
        expect($response)->toBeInstanceOf(GetKeepAliveStreamResponse::class)
            ->and($response->keepAliveStreamRecord->timestamp)->toBeInstanceOf(DateTime::class);
    });
});
