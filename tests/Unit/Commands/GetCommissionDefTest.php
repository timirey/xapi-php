<?php

use Timirey\XApi\Payloads\GetCommissionDefPayload;
use Timirey\XApi\Responses\GetCommissionDefResponse;

test('getCommissionDef command', function () {
    $this->mockClient();

    $getCommissionDefPayload = new GetCommissionDefPayload('EURUSD', 1.0);

    $mockGetCommissionDefResponse = [
        'status' => true,
        'returnData' => [
            'commission' => 5.0,
            'rateOfExchange' => 1.2
        ]
    ];

    $this->mockResponse($getCommissionDefPayload, $mockGetCommissionDefResponse);

    $getCommissionDefResponse = $this->client->getCommissionDef('EURUSD', 1.0);

    expect($getCommissionDefResponse)->toBeInstanceOf(GetCommissionDefResponse::class);
});
