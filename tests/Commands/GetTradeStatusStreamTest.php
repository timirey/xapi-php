<?php

use Timirey\XApi\Enums\RequestStatus;
use Timirey\XApi\Payloads\GetTradeStatusStreamPayload;
use Timirey\XApi\Responses\GetTradeStatusStreamResponse;
use Timirey\XApi\Tests\Commands\Traits\StreamClientMockeryTrait;

uses(StreamClientMockeryTrait::class);

beforeEach(function () {
    $this->mockClient();
});

afterEach(function () {
    Mockery::close();
});

test('getTradeStatus stream command', function (): void {
    $payload = new GetTradeStatusStreamPayload('streamSessionId');
    $mockResponse = [
        'command' => 'tradeStatus',
        'data' => [
            'customComment' => 'Some text',
            'message' => null,
            'order' => 43,
            'price' => 1.392,
            'requestStatus' => 3,
        ],
    ];

    $this->mockResponse($payload, $mockResponse);

    $this->client->getTradeStatus(static function (GetTradeStatusStreamResponse $response): void {
        expect($response)->toBeInstanceOf(GetTradeStatusStreamResponse::class)
            ->and($response->tradeStatusStreamRecord->requestStatus)->toBeInstanceOf(RequestStatus::class);
    });
});
