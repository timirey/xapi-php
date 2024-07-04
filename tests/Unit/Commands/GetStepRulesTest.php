<?php

use Timirey\XApi\Payloads\GetStepRulesPayload;
use Timirey\XApi\Responses\Data\StepRecord;
use Timirey\XApi\Responses\Data\StepRuleRecord;
use Timirey\XApi\Responses\GetStepRulesResponse;

test('getStepRules command', function () {
    $this->mockClient();

    $getStepRulesPayload = new GetStepRulesPayload();

    $mockGetStepRulesResponse = [
        'status' => true,
        'returnData' => [
            [
                'id' => 1,
                'name' => 'Forex',
                'steps' => [
                    [
                        'fromValue' => 0.1,
                        'step' => 0.0025
                    ],
                    [
                        'fromValue' => 1.0,
                        'step' => 0.001
                    ]
                ]
            ],
        ]
    ];

    $this->mockResponse($getStepRulesPayload, $mockGetStepRulesResponse);

    $getStepRulesResponse = $this->client->getStepRules();

    expect($getStepRulesResponse)->toBeInstanceOf(GetStepRulesResponse::class)
        ->and($getStepRulesResponse->stepRuleRecords[0])->toBeInstanceOf(StepRuleRecord::class)
        ->and($getStepRulesResponse->stepRuleRecords[0]->stepRecords[0])->toBeInstanceOf(StepRecord::class);
});
