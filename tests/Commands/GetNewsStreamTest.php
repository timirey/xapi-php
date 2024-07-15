<?php

use Timirey\XApi\Payloads\GetNewsStreamPayload;
use Timirey\XApi\Responses\GetNewsStreamResponse;
use Timirey\XApi\Tests\Commands\Traits\StreamClientMockeryTrait;

uses(StreamClientMockeryTrait::class);

beforeEach(function () {
    $this->mockStreamClient();
});

afterEach(function () {
    Mockery::close();
});

test('getNews stream command', function () {
    $payload = new GetNewsStreamPayload('streamSessionId');
    $mockResponse = [
        'command' => 'news',
        'data' => [
            'body' => '<html>...</html>',
            'key' => '1f6da766abd29927aa854823f0105c23',
            'time' => 1262944112000,
            'title' => 'Breaking trend',
        ],
    ];

    $this->mockStreamResponse($payload, $mockResponse);

    $streamClient = $this->streamClient;

    $streamClient->getNews(function (GetNewsStreamResponse $response) {
        expect($response)->toBeInstanceOf(GetNewsStreamResponse::class)
            ->and($response->newsStreamRecord->time)->toBeInstanceOf(DateTime::class);
    });
});
