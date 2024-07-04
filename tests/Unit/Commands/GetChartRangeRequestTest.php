<?php

use Timirey\XApi\Enums\Period;
use Timirey\XApi\Payloads\Data\ChartRangeInfoRecord;
use Timirey\XApi\Payloads\GetChartRangeRequestPayload;
use Timirey\XApi\Responses\Data\RateInfoRecord;
use Timirey\XApi\Responses\GetChartRangeRequestResponse;

test('getChartRangeRequest command', function () {
    $this->mockClient();

    $chartRangeInfoRecord = new ChartRangeInfoRecord(
        period: Period::PERIOD_H1,
        start: new DateTime('-1 month'),
        end: new DateTime(),
        symbol: 'EURUSD',
        ticks: 1000
    );

    $getChartRangeRequestPayload = new GetChartRangeRequestPayload($chartRangeInfoRecord);

    /**
     * @var ChartRangeInfoRecord $chartRangeRequestArgument
     */
    $chartRangeRequestArgument = $getChartRangeRequestPayload->arguments['info'];

    expect($chartRangeRequestArgument->period)->toBeInstanceOf(Period::class);

    $mockGetChartRangeRequestResponse = [
        'status' => true,
        'returnData' => [
            'digits' => 5,
            'rateInfos' => [
                [
                    'close' => 1.12345,
                    'ctm' => 1389374640000,
                    'ctmString' => 'Jan 10, 2014 3:04:00 PM',
                    'high' => 1.125,
                    'low' => 1.120,
                    'open' => 1.122,
                    'vol' => 100
                ],
            ]
        ]
    ];

    $this->mockResponse($getChartRangeRequestPayload, $mockGetChartRangeRequestResponse);

    $getChartRangeRequestResponse = $this->client->getChartRangeRequest($chartRangeInfoRecord);

    expect($getChartRangeRequestResponse)->toBeInstanceOf(GetChartRangeRequestResponse::class)
        ->and($getChartRangeRequestResponse->rateInfoRecords[0])->toBeInstanceOf(RateInfoRecord::class)
        ->and($getChartRangeRequestResponse->rateInfoRecords[0]->ctm)->toBeInstanceOf(DateTime::class);
});
