<?php

use Timirey\XApi\Payloads\LogoutPayload;
use Timirey\XApi\Responses\LogoutResponse;
use Timirey\XApi\Tests\Commands\Traits\MockeryTrait;

uses(MockeryTrait::class);

beforeEach(function () {
    $this->mockClient();
});

test('logout command', function () {
    $payload = new LogoutPayload();
    $mockResponse = [
        'status' => true,
    ];

    $this->mockResponse($payload, $mockResponse);

    $response = $this->client->logout();

    expect($response)->toBeInstanceOf(LogoutResponse::class);
});
