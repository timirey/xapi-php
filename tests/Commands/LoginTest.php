<?php

use Timirey\XApi\Payloads\LoginPayload;
use Timirey\XApi\Responses\LoginResponse;
use Timirey\XApi\Tests\Commands\Traits\ClientMockeryTrait;

uses(ClientMockeryTrait::class);

beforeEach(function () {
    $this->mockClient();
});

afterEach(function () {
    Mockery::close();
});

test('login command', function () {
    $payload = new LoginPayload(12345, 'password');
    $mockResponse = [
                     'status'          => true,
                     'streamSessionId' => 'streamSessionId',
                    ];

    $this->mockResponse($payload, $mockResponse);

    $response = $this->client->login();

    expect($response)->toBeInstanceOf(LoginResponse::class);
});
