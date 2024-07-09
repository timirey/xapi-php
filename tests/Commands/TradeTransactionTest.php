<?php

use Timirey\XApi\Enums\Cmd;
use Timirey\XApi\Enums\Type;
use Timirey\XApi\Payloads\Data\TradeTransInfo;
use Timirey\XApi\Payloads\TradeTransactionPayload;
use Timirey\XApi\Responses\TradeTransactionResponse;
use Timirey\XApi\Tests\Commands\Traits\ClientMockeryTrait;

uses(ClientMockeryTrait::class);

beforeEach(function () {
    $this->mockClient();
});

afterEach(function () {
    Mockery::close();
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

    /**
     * @var TradeTransInfo $tradeTransInfoArgument
     */
    $tradeTransInfoArgument = $payload->parameters['tradeTransInfo'];

    expect($tradeTransInfoArgument)->toBeInstanceOf(TradeTransInfo::class)
        ->and($tradeTransInfoArgument->cmd)->toBeInstanceOf(Cmd::class)
        ->and($tradeTransInfoArgument->type)->toBeInstanceOf(Type::class);

    $mockResponse = [
        'status' => true,
        'returnData' => ['order' => 123456789],
    ];

    $this->mockResponse($payload, $mockResponse);

    $response = $this->client->tradeTransaction($tradeTransInfo);

    expect($response)->toBeInstanceOf(TradeTransactionResponse::class)
        ->and($response->order)->toBe(123456789);
});
