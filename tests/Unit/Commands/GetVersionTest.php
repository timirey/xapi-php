<?php

use Timirey\XApi\Payloads\GetVersionPayload;
use Timirey\XApi\Responses\GetVersionResponse;

test('getVersion command', function () {
    $this->mockClient();

    $getVersionPayload = new GetVersionPayload();

    $mockGetVersionResponse = [
        'status' => true,
        'returnData' => [
            'version' => '2.4.15'
        ]
    ];

    $this->mockResponse($getVersionPayload, $mockGetVersionResponse);

    $getVersionResponse = $this->client->getVersion();

    expect($getVersionResponse)->toBeInstanceOf(GetVersionResponse::class);
});
