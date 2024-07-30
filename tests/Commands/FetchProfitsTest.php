<?php

use Timirey\XApi\Payloads\FetchProfitsPayload;
use Timirey\XApi\Responses\FetchProfitsResponse;
use Timirey\XApi\Tests\Commands\Traits\ClientMockeryTrait;

uses(ClientMockeryTrait::class);

beforeEach(function () {
    $this->mockClient();
});

afterEach(function () {
    Mockery::close();
});

test('fetchProfits stream command', function (): void {
    $payload = new FetchProfitsPayload('streamSessionId');
    $mockResponse = [
        'command' => 'profit',
        'data' => [
            'order' => 7497776,
            'order2' => 7497777,
            'position' => 7497776,
            'profit' => 7076.52,
        ],
    ];

    $this->mockStreamResponse($payload, $mockResponse);

    $this->client->fetchProfits(static function (FetchProfitsResponse $response): void {
        expect($response)->toBeInstanceOf(FetchProfitsResponse::class);
    });
});
