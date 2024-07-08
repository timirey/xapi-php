<?php

use Timirey\XApi\Enums\Period;
use Timirey\XApi\Helpers\DateTimeHelper;
use Timirey\XApi\Payloads\Data\ChartLastInfoRecord;
use Timirey\XApi\Payloads\GetChartLastRequestPayload;
use Timirey\XApi\Responses\Data\RateInfoRecord;
use Timirey\XApi\Responses\GetChartLastRequestResponse;
use Timirey\XApi\Tests\Commands\Traits\ClientMockeryTrait;

uses(ClientMockeryTrait::class);

beforeEach(function () {
    $this->mockClient();
});

afterEach(function () {
    Mockery::close();
});

test('getChartLastRequest command', function () {
    $chartLastInfoRecord = new ChartLastInfoRecord(
        period: Period::PERIOD_M1,
        start: new DateTime(),
        symbol: 'EURUSD'
    );

    $payload = new GetChartLastRequestPayload($chartLastInfoRecord);

    /**
     * @var ChartLastInfoRecord $chartLastInfoRecordArgument
     */
    $chartLastInfoRecordArgument = $payload->parameters['info'];
    expect($chartLastInfoRecordArgument->period)->toBeInstanceOf(Period::class);

    $mockResponse = [
                     'status'     => true,
                     'returnData' => [
                                      'digits'    => 5,
                                      'rateInfos' => [
                                                      [
                                                       'close'     => 1.12345,
                                                       'ctm'       => DateTimeHelper::toMilliseconds(new DateTime()),
                                                       'ctmString' => 'Jan 10, 2014 3:04:00 PM',
                                                       'high'      => 1.125,
                                                       'low'       => 1.120,
                                                       'open'      => 1.122,
                                                       'vol'       => 100,
                                                      ],
                                                     ],
                                     ],
                    ];

    $this->mockResponse($payload, $mockResponse);

    $response = $this->client->getChartLastRequest($chartLastInfoRecord);

    expect($response)->toBeInstanceOf(GetChartLastRequestResponse::class)
        ->and($response->rateInfoRecords[0])->toBeInstanceOf(RateInfoRecord::class)
        ->and($response->rateInfoRecords[0]->ctm)->toBeInstanceOf(DateTime::class);
});
