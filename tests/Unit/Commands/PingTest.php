<?php

use Timirey\XApi\Payloads\PingPayload;
use Timirey\XApi\Responses\PingResponse;

test('ping command', function () {
    $this->mockClient();

    $pingPayload = new PingPayload();

    $mockPingResponse = [
        'status' => true,
    ];

    $this->mockResponse($pingPayload, $mockPingResponse);

    $pingResponse = $this->client->ping();

    expect($pingResponse)->toBeInstanceOf(PingResponse::class);
});
