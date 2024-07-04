<?php

use Timirey\XApi\Enums\Cmd;
use Timirey\XApi\Payloads\GetProfitCalculationPayload;
use Timirey\XApi\Responses\GetProfitCalculationResponse;

test('getProfitCalculation command', function () {
    $this->mockClient();

    $getProfitCalculationPayload = new GetProfitCalculationPayload(
        1.3000,
        Cmd::BUY,
        1.2233,
        'EURPLN',
        1.0
    );

    $mockGetProfitCalculationResponse = [
        'status' => true,
        'returnData' => [
            'profit' => 714.303
        ]
    ];

    $this->mockResponse($getProfitCalculationPayload, $mockGetProfitCalculationResponse);

    $getProfitCalculationResponse = $this->client->getProfitCalculation(
        1.3000,
        Cmd::BUY,
        1.2233,
        'EURPLN',
        1.0
    );

    expect($getProfitCalculationResponse)->toBeInstanceOf(GetProfitCalculationResponse::class);
});
