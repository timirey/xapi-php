<?php

use Timirey\XApi\Enums\QuoteId;
use Timirey\XApi\Payloads\FetchCandlesPayload;
use Timirey\XApi\Responses\FetchCandlesResponse;
use Timirey\XApi\Tests\Commands\Traits\ClientMockeryTrait;

uses(ClientMockeryTrait::class);

beforeEach(function () {
    $this->mockClient();
});

afterEach(function () {
    Mockery::close();
});

test('fetchCandles stream command', function (): void {
    $payload = new FetchCandlesPayload('streamSessionId', 'EURUSD');
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

    $this->mockStreamResponse($payload, $mockResponse);

    $this->client->fetchCandles('EURUSD', static function (FetchCandlesResponse $response): void {
        expect($response)->toBeInstanceOf(FetchCandlesResponse::class)
            ->and($response->candleStreamRecord->ctm)->toBeInstanceOf(DateTime::class)
            ->and($response->candleStreamRecord->quoteId)->toBeInstanceOf(QuoteId::class);
    });
});
