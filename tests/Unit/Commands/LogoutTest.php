<?php

use Timirey\XApi\Payloads\LoginPayload;
use Timirey\XApi\Payloads\LogoutPayload;
use Timirey\XApi\Responses\LoginResponse;
use Timirey\XApi\Responses\LogoutResponse;

test('logout command', function () {
    $this->mockClient();

    $logoutPayload = new LogoutPayload();

    $mockLogoutResponse = [
        'status' => true,
    ];

    $this->mockResponse($logoutPayload, $mockLogoutResponse);

    $logoutResponse = $this->client->logout();

    expect($logoutResponse)->toBeInstanceOf(LogoutResponse::class);
});
