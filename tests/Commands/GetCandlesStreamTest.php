<?php

use Timirey\XApi\Payloads\GetCandlesStreamPayload;
use Timirey\XApi\Responses\GetCandlesStreamResponse;
use Timirey\XApi\Tests\Commands\Traits\StreamClientMockeryTrait;

uses(StreamClientMockeryTrait::class);

beforeEach(function () {
    $this->mockStreamClient();
});

afterEach(function () {
    Mockery::close();
});

test('getCandles stream command', function () {
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

    $this->mockStreamResponse($payload, $mockResponse);

    $client = $this->client;

    $client->getCandles('EURUSD', function (GetCandlesStreamResponse $response) use ($client) {
        expect($response)->toBeInstanceOf(GetCandlesStreamResponse::class)
            ->and($response->streamCandleRecord->close)->toBe(4.1849);

        $client->unsubscribe();
    });
});
