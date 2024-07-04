<?php

use Timirey\XApi\Enums\RequestStatus;
use Timirey\XApi\Payloads\TradeTransactionStatusPayload;
use Timirey\XApi\Responses\TradeTransactionStatusResponse;
use Timirey\XApi\Tests\Commands\Traits\MockeryTrait;

uses(MockeryTrait::class);

beforeEach(function () {
    $this->mockClient();
});

afterEach(function () {
    Mockery::close();
});

test('tradeTransactionStatus command', function () {
    $payload = new TradeTransactionStatusPayload(123456789);
    $mockResponse = [
        'status' => true,
        'returnData' => [
            'ask' => 1.12350,
            'bid' => 1.12345,
            'customComment' => 'Test trade',
            'message' => 'Success',
            'order' => 123456789,
            'requestStatus' => RequestStatus::PENDING,
        ],
    ];

    $this->mockResponse($payload, $mockResponse);

    $response = $this->client->tradeTransactionStatus(123456789);

    expect($response)->toBeInstanceOf(TradeTransactionStatusResponse::class)
        ->and($response->requestStatus)->toBe(RequestStatus::PENDING);
});
