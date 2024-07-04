<?php

use Timirey\XApi\Payloads\GetCurrentUserDataPayload;
use Timirey\XApi\Responses\GetCurrentUserDataResponse;
use Timirey\XApi\Tests\Commands\Traits\MockeryTrait;

uses(MockeryTrait::class);

beforeEach(function () {
    $this->mockClient();
});

afterEach(function () {
    Mockery::close();
});

test('getCurrentUserData command', function () {
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

    expect($response)->toBeInstanceOf(GetCurrentUserDataResponse::class)
        ->and($response->companyUnit)->toBe(8)
        ->and($response->currency)->toBe('PLN')
        ->and($response->group)->toBe('demoPLeurSTANDARD200')
        ->and($response->ibAccount)->toBe(false)
        ->and($response->leverage)->toBe(1)
        ->and($response->leverageMultiplier)->toBe(0.25)
        ->and($response->spreadType)->toBe('FLOAT')
        ->and($response->trailingStop)->toBe(false);
});
