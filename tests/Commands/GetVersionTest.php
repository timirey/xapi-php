<?php

use Timirey\XApi\Payloads\GetVersionPayload;
use Timirey\XApi\Responses\GetVersionResponse;
use Timirey\XApi\Tests\Commands\Traits\MockeryTrait;

uses(MockeryTrait::class);

beforeEach(function () {
    $this->mockClient();
});

test('getVersion command', function () {
    $payload = new GetVersionPayload();
    $mockResponse = [
        'status' => true,
        'returnData' => [
            'version' => '2.4.15',
        ],
    ];

    $this->mockResponse($payload, $mockResponse);

    $response = $this->client->getVersion();

    expect($response)->toBeInstanceOf(GetVersionResponse::class);
});
