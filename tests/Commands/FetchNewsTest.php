<?php

use Timirey\XApi\Payloads\FetchNewsPayload;
use Timirey\XApi\Responses\FetchNewsResponse;
use Timirey\XApi\Tests\Commands\Traits\ClientMockeryTrait;

uses(ClientMockeryTrait::class);

beforeEach(function () {
    $this->mockClient();
});

afterEach(function () {
    Mockery::close();
});

test('fetchNews stream command', function (): void {
    $payload = new FetchNewsPayload('streamSessionId');
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

    $this->client->fetchNews(static function (FetchNewsResponse $response): void {
        expect($response)->toBeInstanceOf(FetchNewsResponse::class)
            ->and($response->newsStreamRecord->time)->toBeInstanceOf(DateTime::class);
    });
});
