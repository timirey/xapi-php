<?php

use Timirey\XApi\Clients\Client;
use Timirey\XApi\Clients\Enums\Host;
use Timirey\XApi\Payloads\Data\TradeTransInfo;
use Timirey\XApi\Payloads\GetAllSymbolsPayload;
use Timirey\XApi\Payloads\GetSymbolPayload;
use Timirey\XApi\Payloads\LoginPayload;
use Timirey\XApi\Payloads\LogoutPayload;
use Timirey\XApi\Payloads\PingPayload;
use Timirey\XApi\Payloads\TradeTransactionPayload;
use Timirey\XApi\Payloads\TradeTransactionStatusPayload;
use Timirey\XApi\Responses\GetAllSymbolsResponse;
use Timirey\XApi\Responses\GetSymbolResponse;
use Timirey\XApi\Responses\LogoutResponse;
use Timirey\XApi\Responses\PingResponse;
use Timirey\XApi\Responses\TradeTransactionResponse;
use Timirey\XApi\Responses\TradeTransactionStatusResponse;
use WebSocket\Client as WebSocketClient;
use WebSocket\Message\Message;

beforeEach(function () {
    $this->webSocketClient = Mockery::mock(WebSocketClient::class);

    $this->message = Mockery::mock(Message::class);

    $this->client = new class (12345, 'password', Host::DEMO) extends Client {
        public function setWebSocketClient(WebSocketClient $client): void
        {
            $this->client = $client;
        }
    };

    $this->client->setWebSocketClient($this->webSocketClient);
});

afterEach(function () {
    Mockery::close();
});

test('login command', function () {
    $loginPayload = new LoginPayload(12345, 'password');

    $this->webSocketClient->shouldReceive('text')
        ->once()
        ->with($loginPayload->toJson());

    $mockLoginResponse = json_encode([
        'status' => true,
        'streamSessionId' => 'streamSessionId'
    ]);

    $this->webSocketClient->shouldReceive('receive')
        ->once()
        ->andReturn($this->message);

    $this->message->shouldReceive('getContent')
        ->once()
        ->andReturn($mockLoginResponse);

    $loginResponse = $this->client->login();

    expect($loginResponse->streamSessionId)->toBe('streamSessionId');
});

test('logout command', function () {
    $logoutPayload = new LogoutPayload();

    $this->webSocketClient->shouldReceive('text')
        ->once()
        ->with($logoutPayload->toJson());

    $mockLogoutResponse = json_encode([
        'status' => true
    ]);

    $this->webSocketClient->shouldReceive('receive')
        ->once()
        ->andReturn($this->message);

    $this->message->shouldReceive('getContent')
        ->once()
        ->andReturn($mockLogoutResponse);

    $logoutResponse = $this->client->logout();

    expect($logoutResponse)->toBeInstanceOf(LogoutResponse::class);
});

test('getSymbol command', function () {
    $getSymbolPayload = new GetSymbolPayload('EURUSD');

    $this->webSocketClient->shouldReceive('text')
        ->once()
        ->with($getSymbolPayload->toJson());

    $mockGetSymbolResponse = json_encode([
        'status' => true,
        'returnData' => [
            'symbol' => 'EURUSD',
            'currency' => 'USD',
            'categoryName' => 'Forex',
            'currencyProfit' => 'USD',
            'quoteId' => 1,
            'quoteIdCross' => 1,
            'marginMode' => 1,
            'profitMode' => 1,
            'pipsPrecision' => 5,
            'contractSize' => 100000,
            'exemode' => 1,
            'time' => 1625247600,
            'expiration' => null,
            'stopsLevel' => 1,
            'precision' => 5,
            'swapType' => 0,
            'stepRuleId' => 0,
            'type' => 1,
            'instantMaxVolume' => 100,
            'groupName' => 'Forex Majors',
            'description' => 'Euro vs US Dollar',
            'longOnly' => false,
            'trailingEnabled' => true,
            'marginHedgedStrong' => false,
            'swapEnable' => true,
            'percentage' => 0.01,
            'bid' => 1.12345,
            'ask' => 1.12350,
            'high' => 1.12500,
            'low' => 1.12000,
            'lotMin' => 0.01,
            'lotMax' => 100.0,
            'lotStep' => 0.01,
            'tickSize' => 0.00001,
            'tickValue' => 1.0,
            'swapLong' => -0.5,
            'swapShort' => 0.5,
            'leverage' => 100.0,
            'spreadRaw' => 0.00005,
            'spreadTable' => 0.00005,
            'starting' => null,
            'swap_rollover3days' => 3,
            'marginMaintenance' => null,
            'marginHedged' => 50,
            'initialMargin' => 1000,
            'timeString' => '2021-07-02 12:00:00',
            'shortSelling' => true,
            'currencyPair' => true,
        ]
    ]);

    $this->webSocketClient->shouldReceive('receive')
        ->once()
        ->andReturn($this->message);

    $this->message->shouldReceive('getContent')
        ->once()
        ->andReturn($mockGetSymbolResponse);

    $getSymbolResponse = $this->client->getSymbol('EURUSD');

    expect($getSymbolResponse)->toBeInstanceOf(GetSymbolResponse::class)
        ->and($getSymbolResponse->symbolRecord->symbol)->toBe('EURUSD')
        ->and($getSymbolResponse->symbolRecord->description)->toBe('Euro vs US Dollar');
});

test('getAllSymbols command', function () {
    $getAllSymbolsPayload = new GetAllSymbolsPayload();

    $this->webSocketClient->shouldReceive('text')
        ->once()
        ->with($getAllSymbolsPayload->toJson());

    $mockGetAllSymbolsResponse = json_encode([
        'status' => true,
        'returnData' => [
            [
                'symbol' => 'EURUSD',
                'currency' => 'USD',
                'categoryName' => 'Forex',
                'currencyProfit' => 'USD',
                'quoteId' => 1,
                'quoteIdCross' => 1,
                'marginMode' => 1,
                'profitMode' => 1,
                'pipsPrecision' => 5,
                'contractSize' => 100000,
                'exemode' => 1,
                'time' => 1625247600,
                'expiration' => null,
                'stopsLevel' => 1,
                'precision' => 5,
                'swapType' => 0,
                'stepRuleId' => 0,
                'type' => 1,
                'instantMaxVolume' => 100,
                'groupName' => 'Forex Majors',
                'description' => 'Euro vs US Dollar',
                'longOnly' => false,
                'trailingEnabled' => true,
                'marginHedgedStrong' => false,
                'swapEnable' => true,
                'percentage' => 0.01,
                'bid' => 1.12345,
                'ask' => 1.12350,
                'high' => 1.12500,
                'low' => 1.12000,
                'lotMin' => 0.01,
                'lotMax' => 100.0,
                'lotStep' => 0.01,
                'tickSize' => 0.00001,
                'tickValue' => 1.0,
                'swapLong' => -0.5,
                'swapShort' => 0.5,
                'leverage' => 100.0,
                'spreadRaw' => 0.00005,
                'spreadTable' => 0.00005,
                'starting' => null,
                'swap_rollover3days' => 3,
                'marginMaintenance' => null,
                'marginHedged' => 50,
                'initialMargin' => 1000,
                'timeString' => '2021-07-02 12:00:00',
                'shortSelling' => true,
                'currencyPair' => true,
            ],
        ]
    ]);

    $this->webSocketClient->shouldReceive('receive')
        ->once()
        ->andReturn($this->message);

    $this->message->shouldReceive('getContent')
        ->once()
        ->andReturn($mockGetAllSymbolsResponse);

    $getAllSymbolsResponse = $this->client->getAllSymbols();

    expect($getAllSymbolsResponse)->toBeInstanceOf(GetAllSymbolsResponse::class)
        ->and($getAllSymbolsResponse->symbolRecords)->toHaveCount(1)
        ->and($getAllSymbolsResponse->symbolRecords[0]->symbol)->toBe('EURUSD')
        ->and($getAllSymbolsResponse->symbolRecords[0]->description)->toBe('Euro vs US Dollar');
});

test('tradeTransaction command', function () {
    $tradeTransInfo = new TradeTransInfo(
        cmd: 0,
        customComment: 'Test trade',
        expiration: time() + 3600,
        offset: 0,
        order: 0,
        price: 1.12345,
        sl: 1.12000,
        symbol: 'EURUSD',
        tp: 1.12500,
        type: 0,
        volume: 1.0
    );

    $tradeTransactionPayload = new TradeTransactionPayload($tradeTransInfo);

    $this->webSocketClient->shouldReceive('text')
        ->once()
        ->with($tradeTransactionPayload->toJson());

    $mockTradeTransactionResponse = json_encode([
        'status' => true,
        'returnData' => [
            'order' => 123456789
        ]
    ]);

    $this->webSocketClient->shouldReceive('receive')
        ->once()
        ->andReturn($this->message);

    $this->message->shouldReceive('getContent')
        ->once()
        ->andReturn($mockTradeTransactionResponse);

    $tradeTransactionResponse = $this->client->tradeTransaction($tradeTransInfo);

    expect($tradeTransactionResponse)->toBeInstanceOf(TradeTransactionResponse::class)
        ->and($tradeTransactionResponse->order)->toBe(123456789);
});

test('tradeTransactionStatus command', function () {
    $tradeTransactionStatusPayload = new TradeTransactionStatusPayload(123456789);

    $this->webSocketClient->shouldReceive('text')
        ->once()
        ->with($tradeTransactionStatusPayload->toJson());

    $mockTradeTransactionStatusResponse = json_encode([
        'status' => true,
        'returnData' => [
            'ask' => 1.12350,
            'bid' => 1.12345,
            'customComment' => 'Test trade',
            'message' => 'Success',
            'order' => 123456789,
            'requestStatus' => 1
        ]
    ]);

    $this->webSocketClient->shouldReceive('receive')
        ->once()
        ->andReturn($this->message);

    $this->message->shouldReceive('getContent')
        ->once()
        ->andReturn($mockTradeTransactionStatusResponse);

    $tradeTransactionStatusResponse = $this->client->tradeTransactionStatus(123456789);

    expect($tradeTransactionStatusResponse)->toBeInstanceOf(TradeTransactionStatusResponse::class)
        ->and($tradeTransactionStatusResponse->order)->toBe(123456789)
        ->and($tradeTransactionStatusResponse->ask)->toBe(1.12350)
        ->and($tradeTransactionStatusResponse->bid)->toBe(1.12345)
        ->and($tradeTransactionStatusResponse->customComment)->toBe('Test trade')
        ->and($tradeTransactionStatusResponse->message)->toBe('Success')
        ->and($tradeTransactionStatusResponse->requestStatus)->toBe(1);
});

test('ping command', function () {
    $pingPayload = new PingPayload();

    $this->webSocketClient->shouldReceive('text')
        ->once()
        ->with($pingPayload->toJson());

    $mockPingResponse = json_encode([
        'status' => true,
    ]);

    $this->webSocketClient->shouldReceive('receive')
        ->once()
        ->andReturn($this->message);

    $this->message->shouldReceive('getContent')
        ->once()
        ->andReturn($mockPingResponse);

    $pingResponse = $this->client->ping();

    expect($pingResponse)->toBeInstanceOf(PingResponse::class);
});
