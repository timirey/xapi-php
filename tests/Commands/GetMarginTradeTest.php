<?php

use Timirey\XApi\Payloads\GetMarginTradePayload;
use Timirey\XApi\Responses\GetMarginTradeResponse;
use Timirey\XApi\Tests\Commands\Traits\MockeryTrait;

uses(MockeryTrait::class);

beforeEach(function () {
    $this->mockClient();
});

test('getMarginTrade command', function () {
    $payload = new GetMarginTradePayload('EURPLN', 1.0);

    $mockResponse = [
        'status' => true,
        'returnData' => [
            'margin' => 4399.350,
        ],
    ];

    $this->mockResponse($payload, $mockResponse);

    $response = $this->client->getMarginTrade('EURPLN', 1.0);

    expect($response)->toBeInstanceOf(GetMarginTradeResponse::class)
        ->and($response->margin)->toBe(4399.350);
});
