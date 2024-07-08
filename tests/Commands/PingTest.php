<?php

use Timirey\XApi\Payloads\PingPayload;
use Timirey\XApi\Responses\PingResponse;
use Timirey\XApi\Tests\Commands\Traits\ClientMockeryTrait;

uses(ClientMockeryTrait::class);

beforeEach(function () {
    $this->mockClient();
});

afterEach(function () {
    Mockery::close();
});

test('ping command', function () {
    $payload = new PingPayload();
    $mockResponse = [
        'status' => true,
    ];

    $this->mockResponse($payload, $mockResponse);

    $response = $this->client->ping();

    expect($response)->toBeInstanceOf(PingResponse::class);
});
