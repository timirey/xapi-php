<?php

use Timirey\XApi\Enums\RequestStatus;
use Timirey\XApi\Payloads\TradeTransactionStatusPayload;
use Timirey\XApi\Responses\TradeTransactionStatusResponse;
use Timirey\XApi\Tests\Commands\Traits\SocketClientMockeryTrait;

uses(SocketClientMockeryTrait::class);

beforeEach(function () {
    $this->mockClient();
});

afterEach(function () {
    Mockery::close();
});

test('tradeTransactionStatus command', function (): void {
    $payload = new TradeTransactionStatusPayload(123456789);
    $mockResponse = [
        'status' => true,
        'returnData' => [
            'ask' => 1.12350,
            'bid' => 1.12345,
            'customComment' => 'Test trade',
            'message' => 'Success',
            'order' => 123456789,
            'requestStatus' => 1,
        ],
    ];

    $this->mockResponse($payload, $mockResponse);

    $response = $this->client->tradeTransactionStatus(123456789);

    expect($response)->toBeInstanceOf(TradeTransactionStatusResponse::class)
        ->and($response->requestStatus)->toBeInstanceOf(RequestStatus::class);
});
