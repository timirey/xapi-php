<?php

use Timirey\XApi\Enums\RequestStatus;
use Timirey\XApi\Payloads\FetchTradeStatusPayload;
use Timirey\XApi\Responses\FetchTradeStatusResponse;
use Timirey\XApi\Tests\Commands\Traits\ClientMockeryTrait;

uses(ClientMockeryTrait::class);

beforeEach(function () {
    $this->mockClient();
});

afterEach(function () {
    Mockery::close();
});

test('fetchTradeStatus stream command', function (): void {
    $payload = new FetchTradeStatusPayload('streamSessionId');
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

    $this->mockStreamResponse($payload, $mockResponse);

    $this->client->fetchTradeStatus(static function (FetchTradeStatusResponse $response): void {
        expect($response)->toBeInstanceOf(FetchTradeStatusResponse::class)
            ->and($response->tradeStatusStreamRecord->requestStatus)->toBeInstanceOf(RequestStatus::class);
    });
});
