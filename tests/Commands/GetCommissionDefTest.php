<?php

use Timirey\XApi\Payloads\GetCommissionDefPayload;
use Timirey\XApi\Responses\GetCommissionDefResponse;
use Timirey\XApi\Tests\Commands\Traits\ClientMockeryTrait;

uses(ClientMockeryTrait::class);

beforeEach(function () {
    $this->mockClient();
});

afterEach(function () {
    Mockery::close();
});

test('getCommissionDef command', function (): void {
    $payload = new GetCommissionDefPayload('EURUSD', 1.0);

    $mockResponse = [
        'status' => true,
        'returnData' => [
            'commission' => 5.0,
            'rateOfExchange' => 1.2,
        ],
    ];

    $this->mockResponse($payload, $mockResponse);

    $response = $this->client->getCommissionDef('EURUSD', 1.0);

    expect($response)->toBeInstanceOf(GetCommissionDefResponse::class);
});
