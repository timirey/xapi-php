<?php

use Timirey\XApi\Payloads\GetBalanceStreamPayload;
use Timirey\XApi\Responses\GetBalanceStreamResponse;
use Timirey\XApi\Tests\Commands\Traits\StreamClientMockeryTrait;

uses(StreamClientMockeryTrait::class);

beforeEach(function () {
    $this->mockClient();
});

afterEach(function () {
    Mockery::close();
});

test('getBalance stream command', function (): void {
    $payload = new GetBalanceStreamPayload('streamSessionId');
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

    $this->mockResponse($payload, $mockResponse);

    $this->client->getBalance(static function (GetBalanceStreamResponse $response): void {
        expect($response)->toBeInstanceOf(GetBalanceStreamResponse::class);
    });
});
