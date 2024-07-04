<?php

use Timirey\XApi\Enums\RequestStatus;
use Timirey\XApi\Payloads\TradeTransactionStatusPayload;
use Timirey\XApi\Responses\TradeTransactionStatusResponse;

test('tradeTransactionStatus command', function () {
    $this->mockClient();

    $tradeTransactionStatusPayload = new TradeTransactionStatusPayload(123456789);

    $mockTradeTransactionStatusResponse = [
        'status' => true,
        'returnData' => [
            'ask' => 1.12350,
            'bid' => 1.12345,
            'customComment' => 'Test trade',
            'message' => 'Success',
            'order' => 123456789,
            'requestStatus' => RequestStatus::PENDING
        ]
    ];

    $this->mockResponse($tradeTransactionStatusPayload, $mockTradeTransactionStatusResponse);

    $tradeTransactionStatusResponse = $this->client->tradeTransactionStatus(123456789);

    expect($tradeTransactionStatusResponse)->toBeInstanceOf(TradeTransactionStatusResponse::class)
        ->and($tradeTransactionStatusResponse->requestStatus)->toBe(RequestStatus::PENDING);
});
