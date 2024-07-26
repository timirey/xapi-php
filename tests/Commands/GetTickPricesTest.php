<?php

use Timirey\XApi\Enums\Level;
use Timirey\XApi\Payloads\GetTickPricesPayload;
use Timirey\XApi\Responses\Data\TickRecord;
use Timirey\XApi\Responses\GetTickPricesResponse;
use Timirey\XApi\Tests\Commands\Traits\SocketClientMockeryTrait;

uses(SocketClientMockeryTrait::class);

beforeEach(function () {
    $this->mockClient();
});

afterEach(function () {
    Mockery::close();
});

test('getTickPrices command', function (): void {
    $timestamp = new DateTime();

    $payload = new GetTickPricesPayload(Level::BASE, ['EURPLN', 'AGO.PL'], $timestamp);
    $mockResponse = [
        'status' => true,
        'returnData' => [
            'quotations' => [
                [
                    'ask' => 4000.0,
                    'askVolume' => 15000,
                    'bid' => 4000.0,
                    'bidVolume' => 16000,
                    'high' => 4000.0,
                    'level' => 0,
                    'exemode' => 1,
                    'low' => 3500.0,
                    'spreadRaw' => 0.000003,
                    'spreadTable' => 0.00042,
                    'symbol' => 'KOMB.CZ',
                    'timestamp' => 1272529161605,
                ],
            ],
        ],
    ];

    $this->mockResponse($payload, $mockResponse);

    $response = $this->client->getTickPrices(Level::BASE, ['EURPLN', 'AGO.PL'], $timestamp);

    expect($response)->toBeInstanceOf(GetTickPricesResponse::class)
        ->and($response->quotations[0])->toBeInstanceOf(TickRecord::class)
        ->and($response->quotations[0]->level)->toBeInstanceOf(Level::class)
        ->and($response->quotations[0]->timestamp)->toBeInstanceOf(DateTime::class);
});
