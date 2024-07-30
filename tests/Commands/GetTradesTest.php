<?php

use Timirey\XApi\Enums\Cmd;
use Timirey\XApi\Payloads\GetTradesPayload;
use Timirey\XApi\Responses\Data\TradeRecord;
use Timirey\XApi\Responses\GetTradesResponse;
use Timirey\XApi\Tests\Commands\Traits\ClientMockeryTrait;

uses(ClientMockeryTrait::class);

beforeEach(function () {
    $this->mockClient();
});

afterEach(function () {
    Mockery::close();
});

test('getTrades command', function (): void {
    $payload = new GetTradesPayload(true);
    $mockResponse = [
        'status' => true,
        'returnData' => [
            [
                'close_price' => 1.3256,
                'close_time' => null,
                'close_timeString' => null,
                'closed' => false,
                'cmd' => 0,
                'comment' => 'Web Trader',
                'commission' => 0.0,
                'customComment' => 'Some text',
                'digits' => 4,
                'expiration' => null,
                'expirationString' => null,
                'margin_rate' => 0.0,
                'offset' => 0,
                'open_price' => 1.4,
                'open_time' => 1272380927000,
                'open_timeString' => 'Fri Jan 11 10:03:36 CET 2013',
                'order' => 7497776,
                'order2' => 1234567,
                'position' => 1234567,
                'profit' => -2196.44,
                'sl' => 0.0,
                'storage' => -4.46,
                'symbol' => 'EURUSD',
                'timestamp' => 1272540251000,
                'tp' => 0.0,
                'volume' => 0.10,
            ],
        ],
    ];

    $this->mockResponse($payload, $mockResponse);

    $response = $this->client->getTrades(true);

    expect($response)->toBeInstanceOf(GetTradesResponse::class)
        ->and($response->tradeRecords[0])->toBeInstanceOf(TradeRecord::class)
        ->and($response->tradeRecords[0]->cmd)->toBeInstanceOf(Cmd::class)
        ->and($response->tradeRecords[0]->open_time)->toBeInstanceOf(DateTime::class)
        ->and($response->tradeRecords[0]->timestamp)->toBeInstanceOf(DateTime::class);
});
