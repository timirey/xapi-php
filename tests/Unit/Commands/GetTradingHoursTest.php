<?php

use Timirey\XApi\Enums\Day;
use Timirey\XApi\Payloads\GetTradingHoursPayload;
use Timirey\XApi\Responses\Data\QuotesRecord;
use Timirey\XApi\Responses\Data\TradingHoursRecord;
use Timirey\XApi\Responses\Data\TradingRecord;
use Timirey\XApi\Responses\GetTradingHoursResponse;

test('getTradingHours command', function () {
    $this->mockClient();

    $getTradingHoursPayload = new GetTradingHoursPayload(['EURPLN', 'AGO.PL']);

    $mockGetTradingHoursResponse = [
        'status' => true,
        'returnData' => [
            [
                'quotes' => [
                    ['day' => 2, 'fromT' => 63000000, 'toT' => 63300000],
                ],
                'symbol' => 'USDPLN',
                'trading' => [
                    ['day' => 2, 'fromT' => 63000000, 'toT' => 63300000],
                ]
            ],
        ]
    ];

    $this->mockResponse($getTradingHoursPayload, $mockGetTradingHoursResponse);

    $getTradingHoursResponse = $this->client->getTradingHours(['EURPLN', 'AGO.PL']);

    expect($getTradingHoursResponse)->toBeInstanceOf(GetTradingHoursResponse::class)
        ->and($getTradingHoursResponse->tradingHoursRecords[0])->toBeInstanceOf(TradingHoursRecord::class)
        ->and($getTradingHoursResponse->tradingHoursRecords[0]->quotes[0])->toBeInstanceOf(QuotesRecord::class)
        ->and($getTradingHoursResponse->tradingHoursRecords[0]->quotes[0]->day)->toBe(Day::TUESDAY)
        ->and($getTradingHoursResponse->tradingHoursRecords[0]->quotes[0]->fromT)->toBeInstanceOf(DateTime::class)
        ->and($getTradingHoursResponse->tradingHoursRecords[0]->quotes[0]->toT)->toBeInstanceOf(DateTime::class)
        ->and($getTradingHoursResponse->tradingHoursRecords[0]->trading[0])->toBeInstanceOf(TradingRecord::class)
        ->and($getTradingHoursResponse->tradingHoursRecords[0]->trading[0]->day)->toBe(Day::TUESDAY)
        ->and($getTradingHoursResponse->tradingHoursRecords[0]->trading[0]->fromT)->toBeInstanceOf(DateTime::class)
        ->and($getTradingHoursResponse->tradingHoursRecords[0]->trading[0]->toT)->toBeInstanceOf(DateTime::class);
});
