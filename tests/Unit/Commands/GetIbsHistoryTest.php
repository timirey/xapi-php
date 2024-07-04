<?php

use Timirey\XApi\Enums\Side;
use Timirey\XApi\Payloads\GetIbsHistoryPayload;
use Timirey\XApi\Responses\Data\IbRecord;
use Timirey\XApi\Responses\GetIbsHistoryResponse;

test('getIbsHistory command', function () {
    $this->mockClient();

    $getIbsHistoryPayload = new GetIbsHistoryPayload(new DateTime('-1 month'), new DateTime());

    $mockGetIbsHistoryResponse = [
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
                'volume' => 1.0
            ],
        ]
    ];

    $this->mockResponse($getIbsHistoryPayload, $mockGetIbsHistoryResponse);

    $getIbsHistoryResponse = $this->client->getIbsHistory(new DateTime('-1 month'), new DateTime());

    expect($getIbsHistoryResponse)->toBeInstanceOf(GetIbsHistoryResponse::class)
        ->and($getIbsHistoryResponse->ibRecords[0])->toBeInstanceOf(IbRecord::class)
        ->and($getIbsHistoryResponse->ibRecords[0]->side)->toBe(Side::BUY)
        ->and($getIbsHistoryResponse->ibRecords[0]->timestamp)->toBeInstanceOf(DateTime::class);
});
