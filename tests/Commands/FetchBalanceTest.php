<?php

use Timirey\XApi\Payloads\FetchBalancePayload;
use Timirey\XApi\Responses\FetchBalanceResponse;
use Timirey\XApi\Tests\Commands\Traits\ClientMockeryTrait;

uses(ClientMockeryTrait::class);

beforeEach(function () {
    $this->mockClient();
});

afterEach(function () {
    Mockery::close();
});

test('fetchBalance stream command', function (): void {
    $payload = new FetchBalancePayload('streamSessionId');
    $mockResponse = [
        'command' => 'balance',
        'data' => [
            'balance' => 100000.0,
            'margin' => 0.0,
            'equityFX' => 100000.0,
            'equity' => 100000.0,
            'marginLevel' => 0.0,
            'marginFree' => 100000.0,
            'credit' => 0.0,
            'stockValue' => 0.0,
            'stockLock' => 0.0,
            'cashStockValue' => 0.0,
        ],
    ];

    $this->mockStreamResponse($payload, $mockResponse);

    $this->client->fetchBalance(static function (FetchBalanceResponse $response): void {
        expect($response)->toBeInstanceOf(FetchBalanceResponse::class);
    });
});
