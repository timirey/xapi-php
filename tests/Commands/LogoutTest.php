<?php

use Timirey\XApi\Payloads\LogoutPayload;
use Timirey\XApi\Responses\LogoutResponse;
use Timirey\XApi\Tests\Commands\Traits\SocketClientMockeryTrait;

uses(SocketClientMockeryTrait::class);

beforeEach(function () {
    $this->mockClient();
});

afterEach(function () {
    Mockery::close();
});

test('logout command', function (): void {
    $payload = new LogoutPayload();
    $mockResponse = ['status' => true];

    $this->mockResponse($payload, $mockResponse);

    $response = $this->client->logout();

    expect($response)->toBeInstanceOf(LogoutResponse::class);
});
