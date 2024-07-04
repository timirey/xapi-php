<?php

use Timirey\XApi\Payloads\GetCurrentUserDataPayload;
use Timirey\XApi\Responses\GetCurrentUserDataResponse;

test('getCurrentUserData command', function () {
    $this->mockClient();

    $getCurrentUserDataPayload = new GetCurrentUserDataPayload();

    $mockGetCurrentUserDataResponse = [
        'status' => true,
        'returnData' => [
            'companyUnit' => 8,
            'currency' => 'PLN',
            'group' => 'demoPLeurSTANDARD200',
            'ibAccount' => false,
            'leverage' => 1,
            'leverageMultiplier' => 0.25,
            'spreadType' => 'FLOAT',
            'trailingStop' => false
        ]
    ];

    $this->mockResponse($getCurrentUserDataPayload, $mockGetCurrentUserDataResponse);

    $getCurrentUserDataResponse = $this->client->getCurrentUserData();

    expect($getCurrentUserDataResponse)->toBeInstanceOf(GetCurrentUserDataResponse::class);
});
