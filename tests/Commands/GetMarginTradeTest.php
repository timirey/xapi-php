<?php

use Timirey\XApi\Payloads\GetMarginTradePayload;
use Timirey\XApi\Responses\GetMarginTradeResponse;
use Timirey\XApi\Tests\Commands\Traits\ClientMockeryTrait;

uses(ClientMockeryTrait::class);

beforeEach(function () {
    $this->mockClient();
});

afterEach(function () {
    Mockery::close();
});

test('getMarginTrade command', function () {
    $payload = new GetMarginTradePayload('EURPLN', 1.0);

    $mockResponse = [
        'status' => true,
        'returnData' => ['margin' => 4399.350],
    ];

    $this->mockResponse($payload, $mockResponse);

    $response = $this->client->getMarginTrade('EURPLN', 1.0);

    expect($response)->toBeInstanceOf(GetMarginTradeResponse::class);
});
