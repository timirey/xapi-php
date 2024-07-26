<?php

use Timirey\XApi\Enums\Cmd;
use Timirey\XApi\Payloads\GetProfitCalculationPayload;
use Timirey\XApi\Responses\GetProfitCalculationResponse;
use Timirey\XApi\Tests\Commands\Traits\SocketClientMockeryTrait;

uses(SocketClientMockeryTrait::class);

beforeEach(function () {
    $this->mockClient();
});

afterEach(function () {
    Mockery::close();
});

test('getProfitCalculation command', function (): void {
    $payload = new GetProfitCalculationPayload(
        1.3000,
        Cmd::BUY,
        1.2233,
        'EURPLN',
        1.0
    );

    $mockResponse = [
        'status' => true,
        'returnData' => ['profit' => 714.303],
    ];

    $this->mockResponse($payload, $mockResponse);

    $response = $this->client->getProfitCalculation(
        1.3000,
        Cmd::BUY,
        1.2233,
        'EURPLN',
        1.0
    );

    expect($response)->toBeInstanceOf(GetProfitCalculationResponse::class);
});
