<?php

use Timirey\XApi\Enums\Day;
use Timirey\XApi\Payloads\GetTradingHoursPayload;
use Timirey\XApi\Responses\Data\QuotesRecord;
use Timirey\XApi\Responses\Data\TradingHoursRecord;
use Timirey\XApi\Responses\Data\TradingRecord;
use Timirey\XApi\Responses\GetTradingHoursResponse;
use Timirey\XApi\Tests\Commands\Traits\MockeryTrait;

uses(MockeryTrait::class);

beforeEach(function () {
    $this->mockClient();
});

test('getTradingHours command', function () {
    $payload = new GetTradingHoursPayload(['EURPLN', 'AGO.PL']);
    $mockResponse = [
        'status' => true,
        'returnData' => [
            [
                'quotes' => [
                    ['day' => 2, 'fromT' => 63000000, 'toT' => 63300000],
                ],
                'symbol' => 'USDPLN',
                'trading' => [
                    ['day' => 2, 'fromT' => 63000000, 'toT' => 63300000],
                ],
            ],
        ],
    ];

    $this->mockResponse($payload, $mockResponse);

    $response = $this->client->getTradingHours(['EURPLN', 'AGO.PL']);

    expect($response)->toBeInstanceOf(GetTradingHoursResponse::class)
        ->and($response->tradingHoursRecords[0])->toBeInstanceOf(TradingHoursRecord::class)
        ->and($response->tradingHoursRecords[0]->quotes[0])->toBeInstanceOf(QuotesRecord::class)
        ->and($response->tradingHoursRecords[0]->quotes[0]->day)->toBe(Day::TUESDAY)
        ->and($response->tradingHoursRecords[0]->quotes[0]->fromT)->toBeInstanceOf(DateTime::class)
        ->and($response->tradingHoursRecords[0]->quotes[0]->toT)->toBeInstanceOf(DateTime::class)
        ->and($response->tradingHoursRecords[0]->trading[0])->toBeInstanceOf(TradingRecord::class)
        ->and($response->tradingHoursRecords[0]->trading[0]->day)->toBe(Day::TUESDAY)
        ->and($response->tradingHoursRecords[0]->trading[0]->fromT)->toBeInstanceOf(DateTime::class)
        ->and($response->tradingHoursRecords[0]->trading[0]->toT)->toBeInstanceOf(DateTime::class);
});
