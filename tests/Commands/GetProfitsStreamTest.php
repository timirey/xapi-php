<?php

use Timirey\XApi\Payloads\GetProfitsStreamPayload;
use Timirey\XApi\Responses\GetProfitsStreamResponse;
use Timirey\XApi\Tests\Commands\Traits\StreamClientMockeryTrait;

uses(StreamClientMockeryTrait::class);

beforeEach(function () {
    $this->mockClient();
});

afterEach(function () {
    Mockery::close();
});

test('getProfits stream command', function (): void {
    $payload = new GetProfitsStreamPayload('streamSessionId');
    $mockResponse = [
        'command' => 'profit',
        'data' => [
            'order' => 7497776,
            'order2' => 7497777,
            'position' => 7497776,
            'profit' => 7076.52,
        ],
    ];

    $this->mockResponse($payload, $mockResponse);

    $this->client->getProfits(static function (GetProfitsStreamResponse $response): void {
        expect($response)->toBeInstanceOf(GetProfitsStreamResponse::class);
    });
});
