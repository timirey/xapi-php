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

    $client = $this->client;

    $client->getTradeStatus(function (GetTradeStatusStreamResponse $response) use ($client) {
        expect($response)->toBeInstanceOf(GetTradeStatusStreamResponse::class)
            ->and($response->streamTradeStatusRecord->requestStatus)->toBeInstanceOf(RequestStatus::class);

        $client->unsubscribe();
    });
});
