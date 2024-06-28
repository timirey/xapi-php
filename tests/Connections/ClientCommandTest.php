<?php

use Timirey\XApi\Connections\Client;
use Timirey\XApi\Connections\Enums\Host;
use Timirey\XApi\Payloads\Data\ChartLastInfoRecord;
use Timirey\XApi\Payloads\Data\ChartRangeInfoRecord;
use Timirey\XApi\Payloads\Data\TradeTransInfo;
use Timirey\XApi\Payloads\GetAllSymbolsPayload;
use Timirey\XApi\Payloads\GetCalendarPayload;
use Timirey\XApi\Payloads\GetChartLastRequestPayload;
use Timirey\XApi\Payloads\GetChartRangeRequestPayload;
use Timirey\XApi\Payloads\GetCommissionDefPayload;
use Timirey\XApi\Payloads\GetCurrentUserDataPayload;
use Timirey\XApi\Payloads\GetIbsHistoryPayload;
use Timirey\XApi\Payloads\GetMarginLevelPayload;
use Timirey\XApi\Payloads\GetMarginTradePayload;
use Timirey\XApi\Payloads\GetNewsPayload;
use Timirey\XApi\Payloads\GetProfitCalculationPayload;
use Timirey\XApi\Payloads\GetServerTimePayload;
use Timirey\XApi\Payloads\GetSymbolPayload;
use Timirey\XApi\Payloads\LoginPayload;
use Timirey\XApi\Payloads\LogoutPayload;
use Timirey\XApi\Payloads\PingPayload;
use Timirey\XApi\Payloads\TradeTransactionPayload;
use Timirey\XApi\Payloads\TradeTransactionStatusPayload;
use Timirey\XApi\Responses\Data\CalendarRecord;
use Timirey\XApi\Responses\Data\IbRecord;
use Timirey\XApi\Responses\Data\NewsTopicRecord;
use Timirey\XApi\Responses\Data\RateInfoRecord;
use Timirey\XApi\Responses\GetAllSymbolsResponse;
use Timirey\XApi\Responses\GetCalendarResponse;
use Timirey\XApi\Responses\GetChartLastRequestResponse;
use Timirey\XApi\Responses\GetChartRangeRequestResponse;
use Timirey\XApi\Responses\GetCommissionDefResponse;
use Timirey\XApi\Responses\GetCurrentUserDataResponse;
use Timirey\XApi\Responses\GetIbsHistoryResponse;
use Timirey\XApi\Responses\GetMarginLevelResponse;
use Timirey\XApi\Responses\GetMarginTradeResponse;
use Timirey\XApi\Responses\GetNewsResponse;
use Timirey\XApi\Responses\GetProfitCalculationResponse;
use Timirey\XApi\Responses\GetServerTimeResponse;
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

test('getCalendar command', function () {
    $getCalendarPayload = new GetCalendarPayload();

    $this->webSocketClient->shouldReceive('text')
        ->once()
        ->with($getCalendarPayload->toJson());

    $mockGetCalendarResponse = json_encode([
        'status' => true,
        'returnData' => [
            [
                'country' => 'US',
                'current' => '',
                'forecast' => '3.5%',
                'impact' => 'High',
                'period' => 'Q1 2021',
                'previous' => '3.2%',
                'time' => 1720170000000,
                'title' => 'GDP Growth Rate'
            ],
        ]
    ]);

    $this->webSocketClient->shouldReceive('receive')
        ->once()
        ->andReturn($this->message);

    $this->message->shouldReceive('getContent')
        ->once()
        ->andReturn($mockGetCalendarResponse);

    $getCalendarResponse = $this->client->getCalendar();

    expect($getCalendarResponse)->toBeInstanceOf(GetCalendarResponse::class)
        ->and($getCalendarResponse->calendarRecords)->toHaveCount(1)
        ->and($getCalendarResponse->calendarRecords[0])->toBeInstanceOf(CalendarRecord::class)
        ->and($getCalendarResponse->calendarRecords[0]->country)->toBe('US')
        ->and($getCalendarResponse->calendarRecords[0]->title)->toBe('GDP Growth Rate');
});

test('getChartLastRequest command', function () {
    $chartLastInfoRecord = new ChartLastInfoRecord(
        period: 1,
        start: 1389374640000,
        symbol: 'EURUSD'
    );

    $getChartLastRequestPayload = new GetChartLastRequestPayload($chartLastInfoRecord);

    $this->webSocketClient->shouldReceive('text')
        ->once()
        ->with($getChartLastRequestPayload->toJson());

    $mockGetChartLastRequestResponse = json_encode([
        'status' => true,
        'returnData' => [
            'digits' => 5,
            'rateInfos' => [
                [
                    'close' => 1.12345,
                    'ctm' => 1389374640000,
                    'ctmString' => 'Jan 10, 2014 3:04:00 PM',
                    'high' => 1.125,
                    'low' => 1.120,
                    'open' => 1.122,
                    'vol' => 100
                ],
            ]
        ]
    ]);

    $this->webSocketClient->shouldReceive('receive')
        ->once()
        ->andReturn($this->message);

    $this->message->shouldReceive('getContent')
        ->once()
        ->andReturn($mockGetChartLastRequestResponse);

    $getChartLastRequestResponse = $this->client->getChartLastRequest($chartLastInfoRecord);

    expect($getChartLastRequestResponse)->toBeInstanceOf(GetChartLastRequestResponse::class)
        ->and($getChartLastRequestResponse->digits)->toBe(5)
        ->and($getChartLastRequestResponse->rateInfoRecords)->toHaveCount(1)
        ->and($getChartLastRequestResponse->rateInfoRecords[0])->toBeInstanceOf(RateInfoRecord::class)
        ->and($getChartLastRequestResponse->rateInfoRecords[0]->close)->toBe(1.12345)
        ->and($getChartLastRequestResponse->rateInfoRecords[0]->ctmString)->toBe('Jan 10, 2014 3:04:00 PM')
        ->and($getChartLastRequestResponse->rateInfoRecords[0]->ctm)->toBe(1389374640000)
        ->and($getChartLastRequestResponse->rateInfoRecords[0]->high)->toBe(1.125)
        ->and($getChartLastRequestResponse->rateInfoRecords[0]->low)->toBe(1.120)
        ->and($getChartLastRequestResponse->rateInfoRecords[0]->open)->toBe(1.122)
        ->and($getChartLastRequestResponse->rateInfoRecords[0]->vol)->toBe(100.0);
});

test('getChartRangeRequest command', function () {
    $chartRangeInfoRecord = new ChartRangeInfoRecord(
        period: 60,
        start: 1389374640000, // Example start timestamp in milliseconds (Jan 10, 2014 3:04:00 PM)
        end: 1389378240000,   // Example end timestamp in milliseconds
        symbol: 'EURUSD',
        ticks: 1000
    );

    $getChartRangeRequestPayload = new GetChartRangeRequestPayload($chartRangeInfoRecord);

    $this->webSocketClient->shouldReceive('text')
        ->once()
        ->with($getChartRangeRequestPayload->toJson());

    $mockGetChartRangeRequestResponse = json_encode([
        'status' => true,
        'returnData' => [
            'digits' => 5,
            'rateInfos' => [
                [
                    'close' => 1.12345,
                    'ctm' => 1389374640000,
                    'ctmString' => 'Jan 10, 2014 3:04:00 PM',
                    'high' => 1.125,
                    'low' => 1.120,
                    'open' => 1.122,
                    'vol' => 100
                ],
                // Add more rate info records if needed
            ]
        ]
    ]);

    $this->webSocketClient->shouldReceive('receive')
        ->once()
        ->andReturn($this->message);

    $this->message->shouldReceive('getContent')
        ->once()
        ->andReturn($mockGetChartRangeRequestResponse);

    $getChartRangeRequestResponse = $this->client->getChartRangeRequest($chartRangeInfoRecord);

    expect($getChartRangeRequestResponse)->toBeInstanceOf(GetChartRangeRequestResponse::class)
        ->and($getChartRangeRequestResponse->digits)->toBe(5)
        ->and($getChartRangeRequestResponse->rateInfoRecords)->toHaveCount(1)
        ->and($getChartRangeRequestResponse->rateInfoRecords[0])->toBeInstanceOf(RateInfoRecord::class)
        ->and($getChartRangeRequestResponse->rateInfoRecords[0]->close)->toBe(1.12345)
        ->and($getChartRangeRequestResponse->rateInfoRecords[0]->ctmString)->toBe('Jan 10, 2014 3:04:00 PM')
        ->and($getChartRangeRequestResponse->rateInfoRecords[0]->ctm)->toBe(1389374640000)
        ->and($getChartRangeRequestResponse->rateInfoRecords[0]->high)->toBe(1.125)
        ->and($getChartRangeRequestResponse->rateInfoRecords[0]->low)->toBe(1.120)
        ->and($getChartRangeRequestResponse->rateInfoRecords[0]->open)->toBe(1.122)
        ->and($getChartRangeRequestResponse->rateInfoRecords[0]->vol)->toBe(100.0);
});

test('getCommissionDef command', function () {
    $symbol = 'EURUSD';
    $volume = 1.0;
    $getCommissionDefPayload = new GetCommissionDefPayload($symbol, $volume);

    $this->webSocketClient->shouldReceive('text')
        ->once()
        ->with($getCommissionDefPayload->toJson());

    $mockGetCommissionDefResponse = json_encode([
        'status' => true,
        'returnData' => [
            'commission' => 5.0,
            'rateOfExchange' => 1.2
        ]
    ]);

    $this->webSocketClient->shouldReceive('receive')
        ->once()
        ->andReturn($this->message);

    $this->message->shouldReceive('getContent')
        ->once()
        ->andReturn($mockGetCommissionDefResponse);

    $getCommissionDefResponse = $this->client->getCommissionDef($symbol, $volume);

    expect($getCommissionDefResponse)->toBeInstanceOf(GetCommissionDefResponse::class)
        ->and($getCommissionDefResponse->commission)->toBe(5.0)
        ->and($getCommissionDefResponse->rateOfExchange)->toBe(1.2);
});

test('getCurrentUserData command', function () {
    $getCurrentUserDataPayload = new GetCurrentUserDataPayload();

    $this->webSocketClient->shouldReceive('text')
        ->once()
        ->with($getCurrentUserDataPayload->toJson());

    $mockGetCurrentUserDataResponse = json_encode([
        'status' => true,
        'returnData' => [
            'companyUnit' => 8,
            'currency' => 'PLN',
            'group' => 'demoPLeurSTANDARD200',
            'ibAccount' => false,
            'leverage' => 1,
            'leverageMultiplier' => 0.25,
            'spreadType' => 'FLOAT',
            'trailingStop' => false
        ]
    ]);

    $this->webSocketClient->shouldReceive('receive')
        ->once()
        ->andReturn($this->message);

    $this->message->shouldReceive('getContent')
        ->once()
        ->andReturn($mockGetCurrentUserDataResponse);

    $getCurrentUserDataResponse = $this->client->getCurrentUserData();

    expect($getCurrentUserDataResponse)->toBeInstanceOf(GetCurrentUserDataResponse::class)
        ->and($getCurrentUserDataResponse->companyUnit)->toBe(8)
        ->and($getCurrentUserDataResponse->currency)->toBe('PLN')
        ->and($getCurrentUserDataResponse->group)->toBe('demoPLeurSTANDARD200')
        ->and($getCurrentUserDataResponse->ibAccount)->toBe(false)
        ->and($getCurrentUserDataResponse->leverage)->toBe(1)
        ->and($getCurrentUserDataResponse->leverageMultiplier)->toBe(0.25)
        ->and($getCurrentUserDataResponse->spreadType)->toBe('FLOAT')
        ->and($getCurrentUserDataResponse->trailingStop)->toBe(false);
});

test('getMarginLevel command', function () {
    $getMarginLevelPayload = new GetMarginLevelPayload();

    $this->webSocketClient->shouldReceive('text')
        ->once()
        ->with($getMarginLevelPayload->toJson());

    $mockGetMarginLevelResponse = json_encode([
        'status' => true,
        'returnData' => [
            'balance' => 995800269.43,
            'credit' => 1000.00,
            'currency' => 'PLN',
            'equity' => 995985397.56,
            'margin' => 572634.43,
            'marginFree' => 995227635.00,
            'marginLevel' => 173930.41
        ]
    ]);

    $this->webSocketClient->shouldReceive('receive')
        ->once()
        ->andReturn($this->message);

    $this->message->shouldReceive('getContent')
        ->once()
        ->andReturn($mockGetMarginLevelResponse);

    $getMarginLevelResponse = $this->client->getMarginLevel();

    expect($getMarginLevelResponse)->toBeInstanceOf(GetMarginLevelResponse::class)
        ->and($getMarginLevelResponse->balance)->toBe(995800269.43)
        ->and($getMarginLevelResponse->credit)->toBe(1000.00)
        ->and($getMarginLevelResponse->currency)->toBe('PLN')
        ->and($getMarginLevelResponse->equity)->toBe(995985397.56)
        ->and($getMarginLevelResponse->margin)->toBe(572634.43)
        ->and($getMarginLevelResponse->marginFree)->toBe(995227635.00)
        ->and($getMarginLevelResponse->marginLevel)->toBe(173930.41);
});

test('getMarginTrade command', function () {
    $symbol = 'EURPLN';
    $volume = 1.0;
    $getMarginTradePayload = new GetMarginTradePayload($symbol, $volume);

    $this->webSocketClient->shouldReceive('text')
        ->once()
        ->with($getMarginTradePayload->toJson());

    $mockGetMarginTradeResponse = json_encode([
        'status' => true,
        'returnData' => [
            'margin' => 4399.350
        ]
    ]);

    $this->webSocketClient->shouldReceive('receive')
        ->once()
        ->andReturn($this->message);

    $this->message->shouldReceive('getContent')
        ->once()
        ->andReturn($mockGetMarginTradeResponse);

    $getMarginTradeResponse = $this->client->getMarginTrade($symbol, $volume);

    expect($getMarginTradeResponse)->toBeInstanceOf(GetMarginTradeResponse::class)
        ->and($getMarginTradeResponse->margin)->toBe(4399.350);
});

test('getNews command', function () {
    $start = 1275993488000;
    $end = 0;
    $getNewsPayload = new GetNewsPayload($start, $end);

    $this->webSocketClient->shouldReceive('text')
        ->once()
        ->with($getNewsPayload->toJson());

    $mockGetNewsResponse = json_encode([
        'status' => true,
        'returnData' => [
            [
                'body' => '<html lang="">...</html>',
                'bodylen' => 110,
                'key' => '1f6da766abd29927aa854823f0105c23',
                'time' => 1262944112000,
                'timeString' => 'May 17, 2013 4:30:00 PM',
                'title' => 'Breaking trend'
            ],
        ]
    ]);

    $this->webSocketClient->shouldReceive('receive')
        ->once()
        ->andReturn($this->message);

    $this->message->shouldReceive('getContent')
        ->once()
        ->andReturn($mockGetNewsResponse);

    $getNewsResponse = $this->client->getNews($start, $end);

    expect($getNewsResponse)->toBeInstanceOf(GetNewsResponse::class)
        ->and($getNewsResponse->newsTopicRecords)->toHaveCount(1)
        ->and($getNewsResponse->newsTopicRecords[0])->toBeInstanceOf(NewsTopicRecord::class)
        ->and($getNewsResponse->newsTopicRecords[0]->body)->toBe('<html lang="">...</html>')
        ->and($getNewsResponse->newsTopicRecords[0]->bodylen)->toBe(110)
        ->and($getNewsResponse->newsTopicRecords[0]->key)->toBe('1f6da766abd29927aa854823f0105c23')
        ->and($getNewsResponse->newsTopicRecords[0]->time)->toBe(1262944112000)
        ->and($getNewsResponse->newsTopicRecords[0]->timeString)->toBe('May 17, 2013 4:30:00 PM')
        ->and($getNewsResponse->newsTopicRecords[0]->title)->toBe('Breaking trend');
});

test('getIbsHistory command', function () {
    $start = 1394449010991;
    $end = 1395053810991;
    $getIbsHistoryPayload = new GetIbsHistoryPayload($start, $end);

    $this->webSocketClient->shouldReceive('text')
        ->once()
        ->with($getIbsHistoryPayload->toJson());

    $mockGetIbsHistoryResponse = json_encode([
        'status' => true,
        'returnData' => [
            [
                'closePrice' => 1.39302,
                'login' => '12345',
                'nominal' => 6.00,
                'openPrice' => 1.39376,
                'side' => 0,
                'surname' => 'IB_Client_1',
                'symbol' => 'EURUSD',
                'timestamp' => 1395755870000,
                'volume' => 1.0
            ],
        ]
    ]);

    $this->webSocketClient->shouldReceive('receive')
        ->once()
        ->andReturn($this->message);

    $this->message->shouldReceive('getContent')
        ->once()
        ->andReturn($mockGetIbsHistoryResponse);

    $getIbsHistoryResponse = $this->client->getIbsHistory($start, $end);

    expect($getIbsHistoryResponse)->toBeInstanceOf(GetIbsHistoryResponse::class)
        ->and($getIbsHistoryResponse->ibRecords)->toHaveCount(1)
        ->and($getIbsHistoryResponse->ibRecords[0])->toBeInstanceOf(IbRecord::class)
        ->and($getIbsHistoryResponse->ibRecords[0]->closePrice)->toBe(1.39302)
        ->and($getIbsHistoryResponse->ibRecords[0]->login)->toBe('12345')
        ->and($getIbsHistoryResponse->ibRecords[0]->nominal)->toBe(6.00)
        ->and($getIbsHistoryResponse->ibRecords[0]->openPrice)->toBe(1.39376)
        ->and($getIbsHistoryResponse->ibRecords[0]->side)->toBe(0)
        ->and($getIbsHistoryResponse->ibRecords[0]->surname)->toBe('IB_Client_1')
        ->and($getIbsHistoryResponse->ibRecords[0]->symbol)->toBe('EURUSD')
        ->and($getIbsHistoryResponse->ibRecords[0]->timestamp)->toBe(1395755870000)
        ->and($getIbsHistoryResponse->ibRecords[0]->volume)->toBe(1.0);
});

test('getProfitCalculation command', function () {
    $closePrice = 1.3000;
    $cmd = 0;
    $openPrice = 1.2233;
    $symbol = 'EURPLN';
    $volume = 1.0;
    $getProfitCalculationPayload = new GetProfitCalculationPayload($closePrice, $cmd, $openPrice, $symbol, $volume);

    $this->webSocketClient->shouldReceive('text')
        ->once()
        ->with($getProfitCalculationPayload->toJson());

    $mockGetProfitCalculationResponse = json_encode([
        'status' => true,
        'returnData' => [
            'profit' => 714.303
        ]
    ]);

    $this->webSocketClient->shouldReceive('receive')
        ->once()
        ->andReturn($this->message);

    $this->message->shouldReceive('getContent')
        ->once()
        ->andReturn($mockGetProfitCalculationResponse);

    $getProfitCalculationResponse = $this->client->getProfitCalculation($closePrice, $cmd, $openPrice, $symbol, $volume);

    expect($getProfitCalculationResponse)->toBeInstanceOf(GetProfitCalculationResponse::class)
        ->and($getProfitCalculationResponse->profit)->toBe(714.303);
});

test('getServerTime command', function () {
    $getServerTimePayload = new GetServerTimePayload();

    $this->webSocketClient->shouldReceive('text')
        ->once()
        ->with($getServerTimePayload->toJson());

    $mockGetServerTimeResponse = json_encode([
        'status' => true,
        'returnData' => [
            'time' => 1392211379731,
            'timeString' => 'Feb 12, 2014 2:22:59 PM'
        ]
    ]);

    $this->webSocketClient->shouldReceive('receive')
        ->once()
        ->andReturn($this->message);

    $this->message->shouldReceive('getContent')
        ->once()
        ->andReturn($mockGetServerTimeResponse);

    $getServerTimeResponse = $this->client->getServerTime();

    expect($getServerTimeResponse)->toBeInstanceOf(GetServerTimeResponse::class)
        ->and($getServerTimeResponse->time)->toBe(1392211379731)
        ->and($getServerTimeResponse->timeString)->toBe('Feb 12, 2014 2:22:59 PM');
});
