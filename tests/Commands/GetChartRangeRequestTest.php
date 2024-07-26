<?php

use Timirey\XApi\Enums\Period;
use Timirey\XApi\Payloads\Data\ChartRangeInfoRecord;
use Timirey\XApi\Payloads\GetChartRangeRequestPayload;
use Timirey\XApi\Responses\Data\RateInfoRecord;
use Timirey\XApi\Responses\GetChartRangeRequestResponse;
use Timirey\XApi\Tests\Commands\Traits\SocketClientMockeryTrait;

uses(SocketClientMockeryTrait::class);

beforeEach(function () {
    $this->mockClient();
});

afterEach(function () {
    Mockery::close();
});

test('getChartRangeRequest command', function () {
    $chartRangeInfoRecord = new ChartRangeInfoRecord(
        period: Period::PERIOD_H1,
        start: new DateTime('-1 month'),
        end: new DateTime(),
        symbol: 'EURUSD',
        ticks: 1000
    );

    $payload = new GetChartRangeRequestPayload($chartRangeInfoRecord);

    /**
     * @var ChartRangeInfoRecord $chartRangeRequestArgument
     */
    $chartRangeRequestArgument = $payload->parameters['info'];
    expect($chartRangeRequestArgument->period)->toBeInstanceOf(Period::class);

    $mockResponse = [
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
                    'vol' => 100,
                ],
            ],
        ],
    ];

    $this->mockResponse($payload, $mockResponse);

    $response = $this->client->getChartRangeRequest($chartRangeInfoRecord);

    expect($response)->toBeInstanceOf(GetChartRangeRequestResponse::class)
        ->and($response->rateInfoRecords[0])->toBeInstanceOf(RateInfoRecord::class)
        ->and($response->rateInfoRecords[0]->ctm)->toBeInstanceOf(DateTime::class);
});
