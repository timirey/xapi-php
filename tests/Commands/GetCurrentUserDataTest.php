<?php

use Timirey\XApi\Payloads\GetCurrentUserDataPayload;
use Timirey\XApi\Responses\GetCurrentUserDataResponse;
use Timirey\XApi\Tests\Commands\Traits\ClientMockeryTrait;

uses(ClientMockeryTrait::class);

beforeEach(function () {
    $this->mockClient();
});

afterEach(function () {
    Mockery::close();
});

test('getCurrentUserData command', function (): void {
    $payload = new GetCurrentUserDataPayload();

    $mockResponse = [
        'status' => true,
        'returnData' => [
            'companyUnit' => 8,
            'currency' => 'PLN',
            'group' => 'demoPLeurSTANDARD200',
            'ibAccount' => false,
            'leverage' => 1,
            'leverageMultiplier' => 0.25,
            'spreadType' => 'FLOAT',
            'trailingStop' => false,
        ],
    ];

    $this->mockResponse($payload, $mockResponse);

    $response = $this->client->getCurrentUserData();

    expect($response)->toBeInstanceOf(GetCurrentUserDataResponse::class);
});
