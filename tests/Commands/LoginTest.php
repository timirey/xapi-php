<?php

use Timirey\XApi\Payloads\LoginPayload;
use Timirey\XApi\Responses\LoginResponse;
use Timirey\XApi\Tests\Commands\Traits\SocketClientMockeryTrait;

uses(SocketClientMockeryTrait::class);

beforeEach(function () {
    $this->mockClient();
});

afterEach(function () {
    Mockery::close();
});

test('login command', function (): void {
    $payload = new LoginPayload(12345, 'password');
    $mockResponse = [
        'status' => true,
        'streamSessionId' => 'streamSessionId',
    ];

    $this->mockResponse($payload, $mockResponse);

    $response = $this->client->login(12345, 'password');

    expect($response)->toBeInstanceOf(LoginResponse::class);
});
