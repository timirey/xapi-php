<?php

use Timirey\XApi\Payloads\GetBalanceStreamPayload;
use Timirey\XApi\Responses\GetBalanceStreamResponse;
use Timirey\XApi\Tests\Commands\Traits\StreamClientMockeryTrait;

uses(StreamClientMockeryTrait::class);

beforeEach(function () {
    $this->mockStreamClient();
});

afterEach(function () {
    Mockery::close();
});

test('getBalance stream command', function () {
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

    $this->mockStreamResponse($payload, $mockResponse);

    $client = $this->client;

    $client->getBalance(function (GetBalanceStreamResponse $response) use ($client) {
        expect($response)->toBeInstanceOf(GetBalanceStreamResponse::class);

        $client->unsubscribe();
    });
});
