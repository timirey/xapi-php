<?php

use Timirey\XApi\Payloads\PingStreamPayload;
use Timirey\XApi\Responses\PingStreamResponse;
use Timirey\XApi\Tests\Commands\Traits\StreamClientMockeryTrait;

uses(StreamClientMockeryTrait::class);

beforeEach(function () {
    $this->mockStreamClient();
});

afterEach(function () {
    Mockery::close();
});

test('ping stream command', function () {
    $payload = new PingStreamPayload('streamSessionId');
    $mockResponse = [
        'command' => 'ping',
        'data' => []
    ];

    $this->mockStreamResponse($payload, $mockResponse);

    $client = $this->client;

    $client->ping(function (PingStreamResponse $response) use ($client) {
        expect($response)->toBeInstanceOf(PingStreamResponse::class);
        $client->unsubscribe();
    });
});
