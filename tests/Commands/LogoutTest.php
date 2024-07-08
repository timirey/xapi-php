<?php

use Timirey\XApi\Payloads\LogoutPayload;
use Timirey\XApi\Responses\LogoutResponse;
use Timirey\XApi\Tests\Commands\Traits\ClientMockeryTrait;

uses(ClientMockeryTrait::class);

beforeEach(function () {
    $this->mockClient();
});

afterEach(function () {
    Mockery::close();
});

test('logout command', function () {
    $payload = new LogoutPayload();
    $mockResponse = ['status' => true];

    $this->mockResponse($payload, $mockResponse);

    $response = $this->client->logout();

    expect($response)->toBeInstanceOf(LogoutResponse::class);
});
