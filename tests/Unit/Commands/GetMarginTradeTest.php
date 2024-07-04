<?php

use Timirey\XApi\Payloads\GetMarginTradePayload;
use Timirey\XApi\Responses\GetMarginTradeResponse;

test('getMarginTrade command', function () {
    $this->mockClient();

    $getMarginTradePayload = new GetMarginTradePayload('EURPLN', 1.0);

    $mockGetMarginTradeResponse = [
        'status' => true,
        'returnData' => [
            'margin' => 4399.350
        ]
    ];

    $this->mockResponse($getMarginTradePayload, $mockGetMarginTradeResponse);

    $getMarginTradeResponse = $this->client->getMarginTrade('EURPLN', 1.0);

    expect($getMarginTradeResponse)->toBeInstanceOf(GetMarginTradeResponse::class);
});
