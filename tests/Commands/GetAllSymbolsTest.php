<?php

use Timirey\XApi\Enums\MarginMode;
use Timirey\XApi\Enums\ProfitMode;
use Timirey\XApi\Enums\QuoteId;
use Timirey\XApi\Payloads\GetAllSymbolsPayload;
use Timirey\XApi\Responses\GetAllSymbolsResponse;
use Timirey\XApi\Tests\Commands\Traits\SocketClientMockeryTrait;

uses(SocketClientMockeryTrait::class);

beforeEach(function () {
    $this->mockClient();
});

afterEach(function () {
    Mockery::close();
});

test('getAllSymbols command', function (): void {
    $payload = new GetAllSymbolsPayload();
    $mockResponse = [
        'status' => true,
        'returnData' => [
            [
                'symbol' => 'EURUSD',
                'currency' => 'USD',
                'categoryName' => 'Forex',
                'currencyProfit' => 'USD',
                'quoteId' => 1,
                'quoteIdCross' => 1,
                'marginMode' => 101,
                'profitMode' => 6,
                'pipsPrecision' => 5,
                'contractSize' => 100000,
                'exemode' => 1,
                'time' => 1625247600,
                'expiration' => null,
                'stopsLevel' => 1,
                'precision' => 5,
                'swapType' => 0,
                'stepRuleId' => 0,
                'type' => 1,
                'instantMaxVolume' => 100,
                'groupName' => 'Forex Majors',
                'description' => 'Euro vs US Dollar',
                'longOnly' => false,
                'trailingEnabled' => true,
                'marginHedgedStrong' => false,
                'swapEnable' => true,
                'percentage' => 0.01,
                'bid' => 1.12345,
                'ask' => 1.12350,
                'high' => 1.12500,
                'low' => 1.12000,
                'lotMin' => 0.01,
                'lotMax' => 100.0,
                'lotStep' => 0.01,
                'tickSize' => 0.00001,
                'tickValue' => 1.0,
                'swapLong' => -0.5,
                'swapShort' => 0.5,
                'leverage' => 100.0,
                'spreadRaw' => 0.00005,
                'spreadTable' => 0.00005,
                'starting' => null,
                'swap_rollover3days' => 3,
                'marginMaintenance' => null,
                'marginHedged' => 50,
                'initialMargin' => 1000,
                'timeString' => '2021-07-02 12:00:00',
                'shortSelling' => true,
                'currencyPair' => true,
            ],
        ],
    ];

    $this->mockResponse($payload, $mockResponse);

    $response = $this->client->getAllSymbols();

    expect($response)->toBeInstanceOf(GetAllSymbolsResponse::class)
        ->and($response->symbolRecords[0]->quoteId)->toBeInstanceOf(QuoteId::class)
        ->and($response->symbolRecords[0]->profitMode)->toBeInstanceOf(ProfitMode::class)
        ->and($response->symbolRecords[0]->marginMode)->toBeInstanceOf(MarginMode::class);
});
