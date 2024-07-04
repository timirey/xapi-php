<?php

use Timirey\XApi\Enums\Side;
use Timirey\XApi\Payloads\GetIbsHistoryPayload;
use Timirey\XApi\Responses\Data\IbRecord;
use Timirey\XApi\Responses\GetIbsHistoryResponse;
use Timirey\XApi\Tests\Commands\Traits\MockeryTrait;

uses(MockeryTrait::class);

beforeEach(function () {
    $this->mockClient();
});

test('getIbsHistory command', function () {
    $payload = new GetIbsHistoryPayload(new DateTime('-1 month'), new DateTime());

    $mockResponse = [
        'status' => true,
        'returnData' => [
            [
                'closePrice' => 1.39302,
                'login' => '12345',
                'nominal' => 6.00,
                'openPrice' => 1.39376,
                'side' => Side::BUY,
                'surname' => 'IB_Client_1',
                'symbol' => 'EURUSD',
                'timestamp' => 1395755870000,
                'volume' => 1.0,
            ],
        ],
    ];

    $this->mockResponse($payload, $mockResponse);

    $response = $this->client->getIbsHistory(new DateTime('-1 month'), new DateTime());

    expect($response)->toBeInstanceOf(GetIbsHistoryResponse::class)
        ->and($response->ibRecords[0])->toBeInstanceOf(IbRecord::class)
        ->and($response->ibRecords[0]->side)->toBe(Side::BUY)
        ->and($response->ibRecords[0]->timestamp)->toBeInstanceOf(DateTime::class);
});
