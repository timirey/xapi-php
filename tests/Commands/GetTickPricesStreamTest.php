<?php

use Timirey\XApi\Enums\QuoteId;
use Timirey\XApi\Payloads\GetTickPricesStreamPayload;
use Timirey\XApi\Responses\GetTickPricesStreamResponse;
use Timirey\XApi\Tests\Commands\Traits\StreamClientMockeryTrait;

uses(StreamClientMockeryTrait::class);

beforeEach(function () {
    $this->mockClient();
});

afterEach(function () {
    Mockery::close();
});

test('getTickPrices stream command', function (): void {
    $payload = new GetTickPricesStreamPayload('streamSessionId', 'EURUSD', 5000, 2);
    $mockResponse = [
        'command' => 'tickPrices',
        'data' => [
            'ask' => 4000.0,
            'askVolume' => 15000,
            'bid' => 4000.0,
            'bidVolume' => 16000,
            'high' => 4000.0,
            'level' => 0,
            'low' => 3500.0,
            'quoteId' => 1,
            'spreadRaw' => 0.000003,
            'spreadTable' => 0.00042,
            'symbol' => 'KOMB.CZ',
            'timestamp' => 1272529161605,
        ],
    ];

    $this->mockResponse($payload, $mockResponse);

    $this->client->getTickPrices('EURUSD', static function (GetTickPricesStreamResponse $response): void {
        expect($response)->toBeInstanceOf(GetTickPricesStreamResponse::class)
            ->and($response->tickStreamRecord->quoteId)->toBeInstanceOf(QuoteId::class)
            ->and($response->tickStreamRecord->timestamp)->toBeInstanceOf(DateTime::class);
    }, 5000, 2);
});
