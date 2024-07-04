<?php

use Timirey\XApi\Enums\Cmd;
use Timirey\XApi\Enums\Type;
use Timirey\XApi\Payloads\Data\TradeTransInfo;
use Timirey\XApi\Payloads\TradeTransactionPayload;
use Timirey\XApi\Responses\TradeTransactionResponse;

test('tradeTransaction command', function () {
    $this->mockClient();

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

    $tradeTransactionPayload = new TradeTransactionPayload($tradeTransInfo);

    /** @var TradeTransInfo $tradeTransInfoArgument */
    $tradeTransInfoArgument = $tradeTransactionPayload->arguments['tradeTransInfo'];

    expect($tradeTransInfoArgument)->toBeInstanceOf(TradeTransInfo::class)
        ->and($tradeTransInfoArgument->cmd)->toBeInstanceOf(Cmd::class)
        ->and($tradeTransInfoArgument->type)->toBeInstanceOf(Type::class);

    $mockTradeTransactionResponse = [
        'status' => true,
        'returnData' => [
            'order' => 123456789
        ]
    ];

    $this->mockResponse($tradeTransactionPayload, $mockTradeTransactionResponse);

    $tradeTransactionResponse = $this->client->tradeTransaction($tradeTransInfo);

    expect($tradeTransactionResponse)->toBeInstanceOf(TradeTransactionResponse::class);
});
