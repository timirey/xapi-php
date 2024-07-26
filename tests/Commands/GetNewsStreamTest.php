<?php

use Timirey\XApi\Payloads\GetNewsStreamPayload;
use Timirey\XApi\Responses\GetNewsStreamResponse;
use Timirey\XApi\Tests\Commands\Traits\StreamClientMockeryTrait;

uses(StreamClientMockeryTrait::class);

beforeEach(function () {
    $this->mockClient();
});

afterEach(function () {
    Mockery::close();
});

test('getNews stream command', function (): void {
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

    $this->mockResponse($payload, $mockResponse);

    $this->client->getNews(static function (GetNewsStreamResponse $response): void {
        expect($response)->toBeInstanceOf(GetNewsStreamResponse::class)
            ->and($response->newsStreamRecord->time)->toBeInstanceOf(DateTime::class);
    });
});
