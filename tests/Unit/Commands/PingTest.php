<?php

use Timirey\XApi\Payloads\PingPayload;
use Timirey\XApi\Responses\PingResponse;
use Timirey\XApi\Tests\Unit\Commands\Traits\MockeryTrait;

uses(MockeryTrait::class);

beforeEach(function () {
    $this->mockClient();
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
