<?php

use Timirey\XApi\Payloads\LoginPayload;
use Timirey\XApi\Responses\LoginResponse;

test('login command', function () {
    $this->mockClient();

    $loginPayload = new LoginPayload(12345, 'password');

    $mockLoginResponse = [
        'status' => true,
        'streamSessionId' => 'streamSessionId'
    ];

    $this->mockResponse($loginPayload, $mockLoginResponse);

    $loginResponse = $this->client->login();

    expect($loginResponse)->toBeInstanceOf(LoginResponse::class);
});
