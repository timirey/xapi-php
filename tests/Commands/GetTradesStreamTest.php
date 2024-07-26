<?php

use Timirey\XApi\Enums\Cmd;
use Timirey\XApi\Enums\State;
use Timirey\XApi\Enums\Type;
use Timirey\XApi\Payloads\GetTradesStreamPayload;
use Timirey\XApi\Responses\GetTradesStreamResponse;
use Timirey\XApi\Tests\Commands\Traits\StreamClientMockeryTrait;

uses(StreamClientMockeryTrait::class);

beforeEach(function (): void {
    $this->mockClient();
});

afterEach(function (): void {
    Mockery::close();
});

test('getTrades stream command', function (): void {
    $payload = new GetTradesStreamPayload('streamSessionId');
    $mockResponse = [
        'command' => 'trade',
        'data' => [
            'close_price' => 1.3256,
            'close_time' => 1272380929000,
            'closed' => false,
            'cmd' => 0,
            'comment' => 'Web Trader',
            'commission' => 0.0,
            'customComment' => 'Some text',
            'digits' => 4,
            'expiration' => 1272380929000,
            'margin_rate' => 3.9149,
            'offset' => 0,
            'open_price' => 1.4,
            'open_time' => 1272380927000,
            'order' => 7497776,
            'order2' => 1234567,
            'position' => 1234567,
            'profit' => 68.392,
            'sl' => 0.0,
            'state' => 'Modified',
            'storage' => -4.46,
            'symbol' => 'EURUSD',
            'tp' => 0.0,
            'type' => 0,
            'volume' => 0.10,
        ],
    ];

    $this->mockResponse($payload, $mockResponse);

    $this->client->getTrades(static function (GetTradesStreamResponse $response): void {
        expect($response)->toBeInstanceOf(GetTradesStreamResponse::class)
            ->and($response->tradeStreamRecord->cmd)->toBeInstanceOf(Cmd::class)
            ->and($response->tradeStreamRecord->state)->toBeInstanceOf(State::class)
            ->and($response->tradeStreamRecord->type)->toBeInstanceOf(Type::class)
            ->and($response->tradeStreamRecord->expiration)->toBeInstanceOf(DateTime::class)
            ->and($response->tradeStreamRecord->closeTime)->toBeInstanceOf(DateTime::class)
            ->and($response->tradeStreamRecord->openTime)->toBeInstanceOf(DateTime::class);
    });
});
