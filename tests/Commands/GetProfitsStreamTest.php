<?php

use Timirey\XApi\Payloads\GetProfitsStreamPayload;
use Timirey\XApi\Responses\GetProfitsStreamResponse;
use Timirey\XApi\Tests\Commands\Traits\StreamClientMockeryTrait;

uses(StreamClientMockeryTrait::class);

beforeEach(function () {
    $this->mockStreamClient();
});

afterEach(function () {
    Mockery::close();
});

test('getProfits stream command', function () {
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

    $this->mockStreamResponse($payload, $mockResponse);

    $client = $this->client;

    $client->getProfits(function (GetProfitsStreamResponse $response) use ($client) {
        expect($response)->toBeInstanceOf(GetProfitsStreamResponse::class)
            ->and($response->streamProfitRecord->profit)->toBe(7076.52); // todo: add little more tests

        $client->unsubscribe();
    });
});
