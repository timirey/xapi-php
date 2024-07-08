<?php

use Timirey\XApi\Payloads\GetStepRulesPayload;
use Timirey\XApi\Responses\Data\StepRecord;
use Timirey\XApi\Responses\Data\StepRuleRecord;
use Timirey\XApi\Responses\GetStepRulesResponse;
use Timirey\XApi\Tests\Commands\Traits\ClientMockeryTrait;

uses(ClientMockeryTrait::class);

beforeEach(function () {
    $this->mockClient();
});

afterEach(function () {
    Mockery::close();
});

test('getStepRules command', function () {
    $payload = new GetStepRulesPayload();

    $mockResponse = [
        'status' => true,
        'returnData' => [
            [
                'id' => 1,
                'name' => 'Forex',
                'steps' => [
                    [
                        'fromValue' => 0.1,
                        'step' => 0.0025,
                    ],
                    [
                        'fromValue' => 1.0,
                        'step' => 0.001,
                    ],
                ],
            ],
        ],
    ];

    $this->mockResponse($payload, $mockResponse);

    $response = $this->client->getStepRules();

    expect($response)->toBeInstanceOf(GetStepRulesResponse::class)
        ->and($response->stepRuleRecords[0])->toBeInstanceOf(StepRuleRecord::class)
        ->and($response->stepRuleRecords[0]->stepRecords[0])->toBeInstanceOf(StepRecord::class);
});
