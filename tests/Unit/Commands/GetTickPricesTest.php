<?php

use Timirey\XApi\Enums\Level;
use Timirey\XApi\Payloads\GetTickPricesPayload;
use Timirey\XApi\Responses\Data\TickRecord;
use Timirey\XApi\Responses\GetTickPricesResponse;

test('getTickPrices command', function () {
    $this->mockClient();

    $getTickPricesPayload = new GetTickPricesPayload(Level::BASE, ['EURPLN', 'AGO.PL'], new DateTime());

    $mockGetTickPricesResponse = [
        'status' => true,
        'returnData' => [
            'quotations' => [
                [
                    'ask' => 4000.0,
                    'askVolume' => 15000,
                    'bid' => 4000.0,
                    'bidVolume' => 16000,
                    'high' => 4000.0,
                    'level' => Level::BASE,
                    'exemode' => 1,
                    'low' => 3500.0,
                    'spreadRaw' => 0.000003,
                    'spreadTable' => 0.00042,
                    'symbol' => 'KOMB.CZ',
                    'timestamp' => 1272529161605
                ]
            ]
        ]
    ];

    $this->mockResponse($getTickPricesPayload, $mockGetTickPricesResponse);

    $getTickPricesResponse = $this->client->getTickPrices(Level::BASE, ['EURPLN', 'AGO.PL'], new DateTime());

    expect($getTickPricesResponse)->toBeInstanceOf(GetTickPricesResponse::class)
        ->and($getTickPricesResponse->quotations[0])->toBeInstanceOf(TickRecord::class)
        ->and($getTickPricesResponse->quotations[0]->level)->toBe(Level::BASE)
        ->and($getTickPricesResponse->quotations[0]->timestamp)->toBeInstanceOf(DateTime::class);
});
