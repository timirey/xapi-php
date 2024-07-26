<?php

use Timirey\XApi\Enums\QuoteId;
use Timirey\XApi\Payloads\GetCandlesStreamPayload;
use Timirey\XApi\Responses\GetCandlesStreamResponse;
use Timirey\XApi\Tests\Commands\Traits\StreamClientMockeryTrait;

uses(StreamClientMockeryTrait::class);

beforeEach(function () {
    $this->mockClient();
});

afterEach(function () {
    Mockery::close();
});

test('getCandles stream command', function (): void {
    $payload = new GetCandlesStreamPayload('streamSessionId', 'EURUSD');
    $mockResponse = [
        'command' => 'candle',
        'data' => [
            'close' => 4.1849,
            'ctm' => 1378369375000,
            'ctmString' => 'Sep 05, 2013 10:22:55 AM',
            'high' => 4.1854,
            'low' => 4.1848,
            'open' => 4.1848,
            'quoteId' => 2,
            'symbol' => 'EURUSD',
            'vol' => 0.0,
        ],
    ];

    $this->mockResponse($payload, $mockResponse);

    $this->client->getCandles('EURUSD', static function (GetCandlesStreamResponse $response): void {
        expect($response)->toBeInstanceOf(GetCandlesStreamResponse::class)
            ->and($response->candleStreamRecord->ctm)->toBeInstanceOf(DateTime::class)
            ->and($response->candleStreamRecord->quoteId)->toBeInstanceOf(QuoteId::class);
    });
});
