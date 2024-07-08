<?php

use Timirey\XApi\Payloads\GetMarginLevelPayload;
use Timirey\XApi\Responses\GetMarginLevelResponse;
use Timirey\XApi\Tests\Commands\Traits\ClientMockeryTrait;

uses(ClientMockeryTrait::class);

beforeEach(function () {
    $this->mockClient();
});

afterEach(function () {
    Mockery::close();
});

test('getMarginLevel command', function () {
    $payload = new GetMarginLevelPayload();

    $mockResponse = [
                     'status'     => true,
                     'returnData' => [
                                      'balance'     => 995800269.43,
                                      'credit'      => 1000.00,
                                      'currency'    => 'PLN',
                                      'equity'      => 995985397.56,
                                      'margin'      => 572634.43,
                                      'marginFree'  => 995227635.00,
                                      'marginLevel' => 173930.41,
                                     ],
                    ];

    $this->mockResponse($payload, $mockResponse);

    $response = $this->client->getMarginLevel();

    expect($response)->toBeInstanceOf(GetMarginLevelResponse::class)
        ->and($response->balance)->toBe(995800269.43)
        ->and($response->credit)->toBe(1000.00)
        ->and($response->currency)->toBe('PLN')
        ->and($response->equity)->toBe(995985397.56)
        ->and($response->margin)->toBe(572634.43)
        ->and($response->marginFree)->toBe(995227635.00)
        ->and($response->marginLevel)->toBe(173930.41);
});
