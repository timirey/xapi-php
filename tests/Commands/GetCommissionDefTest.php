<?php

use Timirey\XApi\Payloads\GetCommissionDefPayload;
use Timirey\XApi\Responses\GetCommissionDefResponse;
use Timirey\XApi\Tests\Commands\Traits\MockeryTrait;

uses(MockeryTrait::class);

beforeEach(function () {
    $this->mockClient();
});

test('getCommissionDef command', function () {
    $payload = new GetCommissionDefPayload('EURUSD', 1.0);

    $mockResponse = [
        'status' => true,
        'returnData' => [
            'commission' => 5.0,
            'rateOfExchange' => 1.2
        ]
    ];

    $this->mockResponse($payload, $mockResponse);

    $response = $this->client->getCommissionDef('EURUSD', 1.0);

    expect($response)->toBeInstanceOf(GetCommissionDefResponse::class)
        ->and($response->commission)->toBe(5.0)
        ->and($response->rateOfExchange)->toBe(1.2);
});
