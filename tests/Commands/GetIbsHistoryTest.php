<?php

use Timirey\XApi\Enums\Side;
use Timirey\XApi\Payloads\GetIbsHistoryPayload;
use Timirey\XApi\Responses\Data\IbRecord;
use Timirey\XApi\Responses\GetIbsHistoryResponse;
use Timirey\XApi\Tests\Commands\Traits\SocketClientMockeryTrait;

uses(SocketClientMockeryTrait::class);

beforeEach(function () {
    $this->mockClient();
});

afterEach(function () {
    Mockery::close();
});

test('getIbsHistory command', function (): void {
    $start = new DateTime('-1 month');
    $end = new DateTime();

    $payload = new GetIbsHistoryPayload($start, $end);

    $mockResponse = [
        'status' => true,
        'returnData' => [
            [
                'closePrice' => 1.39302,
                'login' => '12345',
                'nominal' => 6.00,
                'openPrice' => 1.39376,
                'side' => 0,
                'surname' => 'IB_Client_1',
                'symbol' => 'EURUSD',
                'timestamp' => 1395755870000,
                'volume' => 1.0,
            ],
        ],
    ];

    $this->mockResponse($payload, $mockResponse);

    $response = $this->client->getIbsHistory($start, $end);

    expect($response)->toBeInstanceOf(GetIbsHistoryResponse::class)
        ->and($response->ibRecords[0])->toBeInstanceOf(IbRecord::class)
        ->and($response->ibRecords[0]->side)->toBeInstanceOf(Side::class)
        ->and($response->ibRecords[0]->timestamp)->toBeInstanceOf(DateTime::class);
});
