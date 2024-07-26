<?php

use Timirey\XApi\Payloads\GetKeepAliveStreamPayload;
use Timirey\XApi\Responses\GetKeepAliveStreamResponse;
use Timirey\XApi\Tests\Commands\Traits\StreamClientMockeryTrait;

uses(StreamClientMockeryTrait::class);

beforeEach(function () {
    $this->mockClient();
});

afterEach(function () {
    Mockery::close();
});

test('getKeepAlive stream command', function (): void {
    $payload = new GetKeepAliveStreamPayload('streamSessionId');
    $mockResponse = [
        'command' => 'keepAlive',
        'data' => ['timestamp' => 1362944112000],
    ];

    $this->mockResponse($payload, $mockResponse);

    $this->client->getKeepAlive(static function (GetKeepAliveStreamResponse $response): void {
        expect($response)->toBeInstanceOf(GetKeepAliveStreamResponse::class)
            ->and($response->keepAliveStreamRecord->timestamp)->toBeInstanceOf(DateTime::class);
    });
});
