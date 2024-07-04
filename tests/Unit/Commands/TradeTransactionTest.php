<?php

use Timirey\XApi\Enums\Cmd;
use Timirey\XApi\Enums\Type;
use Timirey\XApi\Payloads\Data\TradeTransInfo;
use Timirey\XApi\Payloads\TradeTransactionPayload;
use Timirey\XApi\Responses\TradeTransactionResponse;
use Timirey\XApi\Tests\Unit\Commands\Traits\MockeryTrait;

uses(MockeryTrait::class);

beforeEach(function () {
    $this->mockClient();
});

test('tradeTransaction command', function () {
    $tradeTransInfo = new TradeTransInfo(
        cmd: Cmd::BUY,
        customComment: 'Test trade',
        expiration: new DateTime(),
        offset: 0,
        order: 0,
        price: 1.12345,
        sl: 1.12000,
        symbol: 'EURUSD',
        tp: 1.12500,
        type: Type::OPEN,
        volume: 1.0
    );

    $payload = new TradeTransactionPayload($tradeTransInfo);

    /** @var TradeTransInfo $tradeTransInfoArgument */
    $tradeTransInfoArgument = $payload->arguments['tradeTransInfo'];

    expect($tradeTransInfoArgument)->toBeInstanceOf(TradeTransInfo::class)
        ->and($tradeTransInfoArgument->cmd)->toBe(Cmd::BUY)
        ->and($tradeTransInfoArgument->type)->toBe(Type::OPEN);

    $mockResponse = [
        'status' => true,
        'returnData' => [
            'order' => 123456789
        ]
    ];

    $this->mockResponse($payload, $mockResponse);

    $response = $this->client->tradeTransaction($tradeTransInfo);

    expect($response)->toBeInstanceOf(TradeTransactionResponse::class)
        ->and($response->order)->toBe(123456789);
});
