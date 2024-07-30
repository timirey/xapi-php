<?php

use Timirey\XApi\Payloads\FetchKeepAlivePayload;
use Timirey\XApi\Responses\FetchKeepAliveResponse;
use Timirey\XApi\Tests\Commands\Traits\ClientMockeryTrait;

uses(ClientMockeryTrait::class);

beforeEach(function () {
    $this->mockClient();
});

afterEach(function () {
    Mockery::close();
});

test('fetchKeepAlive stream command', function (): void {
    $payload = new FetchKeepAlivePayload('streamSessionId');
    $mockResponse = [
        'command' => 'keepAlive',
        'data' => ['timestamp' => 1362944112000],
    ];

    $this->mockStreamResponse($payload, $mockResponse);

    $this->client->fetchKeepAlive(static function (FetchKeepAliveResponse $response): void {
        expect($response)->toBeInstanceOf(FetchKeepAliveResponse::class)
            ->and($response->keepAliveStreamRecord->timestamp)->toBeInstanceOf(DateTime::class);
    });
});
