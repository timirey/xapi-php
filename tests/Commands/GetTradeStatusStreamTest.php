<?php

use Timirey\XApi\Enums\RequestStatus;
use Timirey\XApi\Payloads\GetTradeStatusStreamPayload;
use Timirey\XApi\Responses\GetTradeStatusStreamResponse;
use Timirey\XApi\Tests\Commands\Traits\StreamClientMockeryTrait;

uses(StreamClientMockeryTrait::class);

beforeEach(function () {
    $this->mockStreamClient();
});

afterEach(function () {
    Mockery::close();
});

test('getTradeStatus stream command', function () {
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

    $this->mockStreamResponse($payload, $mockResponse);

    $streamClient = $this->streamClient;

    $streamClient->getTradeStatus(function (GetTradeStatusStreamResponse $response) {
        expect($response)->toBeInstanceOf(GetTradeStatusStreamResponse::class)
            ->and($response->tradeStatusStreamRecord->requestStatus)->toBeInstanceOf(RequestStatus::class);
    });
});
