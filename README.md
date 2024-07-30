<p align="center">
<img src="https://raw.githubusercontent.com/timirey/xapi-php/master/.github/logo.svg" alt="XTB Online Investing" width="320">
</p>

<p align="center">
<a href="https://github.com/timirey/xapi-php/actions"><img src="https://github.com/timirey/xapi-php/actions/workflows/tests.yml/badge.svg" alt="Tests"></a>
<a href="https://packagist.org/packages/timirey/xapi-php"><img src="https://img.shields.io/packagist/v/timirey/xapi-php" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/timirey/xapi-php"><img src="https://img.shields.io/packagist/dt/timirey/xapi-php" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/timirey/xapi-php"><img src="https://img.shields.io/packagist/l/timirey/xapi-php" alt="License"></a>
</p>

This PHP library provides a comprehensive and user-friendly interface for interacting with the X-Trade Brokers (XTB)
xStation5 Trading API. It supports a wide range of functionalities, including account management, trade execution,
market data retrieval, and real-time streaming commands via socket, making it an ideal tool for developers looking to
integrate advanced trading features and live market data into their applications.

## Table of contents

- [Installation](#installation)
- [Usage](#usage)
- [Available commands](#available-commands)
    - [login](#login)
    - [logout](#logout)
- [Available streaming commands](#available-streaming-commands)
    - [fetchBalance](#fetchbalance-getbalance) (getBalance)
    - [fetchCandles](#fetchcandles-getcandles) (getCandles)
    - [fetchKeepAlive](#fetchkeepalive-getkeepalive) (getKeepAlive)
    - [fetchNews](#fetchnews-getnews) (getNews)
    - [fetchProfits](#fetchprofits-getprofits) (getProfits)
    - [fetchTickPrices](#fetchtickprices-gettickprices) (getTickPrices)
    - [fetchTrades](#fetchtrades-gettrades) (getTrades)
    - [fetchTradeStatus](#fetchtradestatus-gettradestatus) (getTradeStatus)
    - [pingStream](#pingstream-ping) (ping)
- [Retrieving trading data](#retrieving-trading-data)
    - [getAllSymbols](#getallsymbols)
    - [getCalendar](#getcalendar)
    - [getChartLastRequest](#getchartlastrequest)
    - [getChartRangeRequest](#getchartrangerequest)
    - [getCommissionDef](#getcommissiondef)
    - [getCurrentUserData](#getcurrentuserdata)
    - [getIbsHistory](#getibshistory)
    - [getMarginLevel](#getmarginlevel)
    - [getMarginTrade](#getmargintrade)
    - [getNews](#getnews)
    - [getProfitCalculation](#getprofitcalculation)
    - [getServerTime](#getservertime)
    - [getStepRules](#getsteprules)
    - [getSymbol](#getsymbol)
    - [getTickPrices](#gettickprices)
    - [getTradeRecords](#gettraderecords)
    - [getTrades](#gettrades)
    - [getTradesHistory](#gettradeshistory)
    - [getTradingHours](#gettradinghours)
    - [getVersion](#getversion)
    - [ping](#ping)
    - [tradeTransaction](#tradetransaction)
    - [tradeTransactionStatus](#tradetransactionstatus)
- [Error handling](#error-handling)
    - [ErrorResponseException](#errorresponseexception)
    - [InvalidResponseException](#invalidresponseexception)
    - [InvalidPayloadException](#invalidpayloadexception)
    - [SocketException](#socketexception)
- [Testing](#testing)
- [License](#license)
- [Reference](#reference)

## Installation

Install the package via Composer.

```SH
composer require timirey/xapi-php
```

## Usage

Basic usage example.

```PHP
use Timirey\XApi\Client;
use Timirey\XApi\Enums\Host;
use Timirey\XApi\Responses\GetSymbolResponse;

$client = new Client(
    userId: 12345678,
    password: 'password',
    host: Host::DEMO,
    appName: 'My Test App'
);

/**
 * @var $response GetSymbolResponse
 */
$response = $client->getSymbol(
    symbol: 'EURUSD'
);
```

Subscribe to a stream channel.

```PHP
use Timirey\XApi\Client;
use Timirey\XApi\Enums\Host;
use Timirey\XApi\Responses\Data\TickStreamRecord;
use Timirey\XApi\Responses\FetchTickPricesResponse;

$client = new Client(
    userId: 12345678,
    password: 'password',
    host: Host::DEMO,
    appName: 'My Test App'
);

// Meant to be a daemon, run as separate process.
$client->fetchTickPrices(
    symbol: 'EURUSD',
    callback: static function (FetchTickPricesResponse $response): void {
        /**
         * @var TickStreamRecord $record
         */
        $record = $response->tickStreamRecord;
    },
    minArrivalTime: 100,
    maxLevel: 1
);

// Unreachable code.
```

## Available commands

Request-Reply commands are performed on main connection socket. The reply is sent by main connection socket.

### [login](http://developers.xstore.pro/documentation/current#login)

Logs in to the xStation5 API.

```PHP
use Timirey\XApi\Responses\LoginResponse;
use Timirey\XApi\Client;

/** 
 * @var LoginResponse $response 
 * @var Client $client
 */
$response = $client->login(
    userId: 123456789, 
    password: 'password',
    appName: 'My App'
);
```

### [logout](http://developers.xstore.pro/documentation/current#logout)

Logs out from the xStation5 API.

```PHP
use Timirey\XApi\Responses\LogoutResponse;
use Timirey\XApi\Client;

/** 
 * @var LogoutResponse $response
 * @var Client $client
 */
$response = $client->logout();
```

## Available streaming commands

### fetchBalance ([getBalance](http://developers.xstore.pro/documentation/#streamgetBalance))

Allows to get actual account indicators values in real-time, as soon as they are available in the system.

```PHP
use Timirey\XApi\Responses\Data\BalanceStreamRecord;
use Timirey\XApi\Responses\FetchBalanceResponse;
use Timirey\XApi\Client;

/**
 * @var Client $client
 */
$client->fetchBalance(
    callback: static function (FetchBalanceResponse $response): void {
        /**
         * @var BalanceStreamRecord $record
         */
        $record = $response->balanceStreamRecord;
    }
);
```

### fetchCandles ([getCandles](http://developers.xstore.pro/documentation/#streamgetCandles))

Subscribes for and unsubscribes from API chart candles. The interval of every candle is 1 minute. A new candle arrives
every minute.

```PHP
use Timirey\XApi\Responses\Data\CandleStreamRecord;
use Timirey\XApi\Responses\FetchCandlesResponse;
use Timirey\XApi\Client;

/**
 * @var Client $client
 */
$client->fetchCandles(
    symbol: 'EURUSD',
    callback: static function (FetchCandlesResponse $response): void {
        /**
         * @var CandleStreamRecord $record
         */
        $record = $response->candleStreamRecord;
    }
);
```

### fetchKeepAlive ([getKeepAlive](http://developers.xstore.pro/documentation/#streamgetKeepAlive))

Subscribes for and unsubscribes from 'keep alive' messages. A new 'keep alive' message is sent by the API every 3
seconds.

```PHP
use Timirey\XApi\Responses\Data\KeepAliveStreamRecord;
use Timirey\XApi\Responses\FetchKeepAliveResponse;
use Timirey\XApi\Client;

/**
 * @var Client $client
 */
$client->fetchKeepAlive(
    callback: static function (FetchKeepAliveResponse $response): void {
        /**
         * @var KeepAliveStreamRecord $record
         */
        $record = $response->keepAliveStreamRecord;
    }
);
```

### fetchNews ([getNews](http://developers.xstore.pro/documentation/#streamgetNews))

Subscribes for and unsubscribes from news.

```PHP
use Timirey\XApi\Responses\Data\NewsStreamRecord;
use Timirey\XApi\Responses\FetchNewsResponse;
use Timirey\XApi\Client;

/**
 * @var Client $client
 */
$client->fetchNews(
    callback: static function (FetchNewsResponse $response): void {
        /**
         * @var NewsStreamRecord $record
         */
        $record = $response->newsStreamRecord;
    }
);
```

### fetchProfits ([getProfits](http://developers.xstore.pro/documentation/#streamgetProfits))

Subscribes for and unsubscribes from profits.

```PHP
use Timirey\XApi\Responses\Data\ProfitStreamRecord;
use Timirey\XApi\Responses\FetchProfitsResponse;
use Timirey\XApi\Client;

/**
 * @var Client $client
 */
$client->fetchProfits(
    callback: static function (FetchProfitsResponse $response): void {
        /**
         * @var ProfitStreamRecord $record
         */
        $record = $response->profitStreamRecord;
    }
);
```

### fetchTickPrices ([getTickPrices](http://developers.xstore.pro/documentation/#streamgetTickPrices))

Establishes subscription for quotations and allows to obtain the relevant information in real-time, as soon as it is
available in the system.

```PHP
use Timirey\XApi\Responses\Data\TickStreamRecord;
use Timirey\XApi\Responses\FetchTickPricesResponse;
use Timirey\XApi\Client;

/**
 * @var Client $client
 */
$client->fetchTickPrices(
    symbol: 'EURUSD',
    callback: static function (FetchTickPricesResponse $response): void {
        /**
         * @var TickStreamRecord $record
         */
        $record = $response->tickStreamRecord;
    },
    maxLevel: 1,
    minArrivalTime: 200
);
```

### fetchTrades ([getTrades](http://developers.xstore.pro/documentation/#streamgetTrades))

Establishes subscription for user trade status data and allows to obtain the relevant information in real-time, as soon
as it is available in the system.

```PHP
use Timirey\XApi\Responses\Data\TradeStreamRecord;
use Timirey\XApi\Responses\FetchTradesResponse;
use Timirey\XApi\Client;

/**
 * @var Client $client
 */
$client->fetchTrades(
    callback: static function (FetchTradesResponse $response): void {
        /**
         * @var TradeStreamRecord $record
         */
        $record = $response->tradeStreamRecord;
    }
);
```

### fetchTradeStatus ([getTradeStatus](http://developers.xstore.pro/documentation/#streamgetTradeStatus))

Allows to get status for sent trade requests in real-time, as soon as it is available in the system.

```PHP
use Timirey\XApi\Responses\Data\TradeStatusStreamRecord;
use Timirey\XApi\Responses\FetchTradeStatusResponse;
use Timirey\XApi\Client;

/**
 * @var Client $client
 */
$client->fetchTradeStatus(
    callback: static function (FetchTradeStatusResponse $response): void {
        /**
         * @var TradeStatusStreamRecord $record
         */
        $record = $response->tradeStatusStreamRecord;
    }
);
```

### pingStream ([ping](http://developers.xstore.pro/documentation/#streamping))

Regularly calling this function is enough to refresh the internal state of all the components in the system.

```PHP
use Timirey\XApi\Client;

/**
 * @var Client $client
 */
$client->pingStream();
```

## Retrieving trading data

### [getAllSymbols](http://developers.xstore.pro/documentation/current#getAllSymbols)

Retrieves information about all symbols.

```PHP
use Timirey\XApi\Responses\GetAllSymbolsResponse;
use Timirey\XApi\Client;

/** 
 * @var GetAllSymbolsResponse $response 
 * @var Client $client
 */
$response = $client->getAllSymbols();
```

### [getCalendar](http://developers.xstore.pro/documentation/current#getCalendar)

Returns a calendar with market events.

```PHP
use Timirey\XApi\Responses\GetCalendarResponse;
use Timirey\XApi\Client;

/** 
 * @var GetCalendarResponse $response 
 * @var Client $client
 */
$response = $client->getCalendar();
```

### [getChartLastRequest](http://developers.xstore.pro/documentation/current#getChartLastRequest)

Returns chart info from the start date to the current time.

```PHP
use Timirey\XApi\Responses\GetChartLastRequestResponse;
use Timirey\XApi\Client;
use Timirey\XApi\Payloads\Data\ChartLastInfoRecord;
use Timirey\XApi\Enums\Period;
use DateTime;

$chartLastInfoRecord = new ChartLastInfoRecord(
    period: Period::PERIOD_M1,
    start: new DateTime('-1 week'),
    symbol: 'EURUSD'
);

/** 
 * @var GetChartLastRequestResponse $response 
 * @var Client $client
 */
$response = $client->getChartLastRequest(
    chartLastInfoRecord: $chartLastInfoRecord
);
```

### [getChartRangeRequest](http://developers.xstore.pro/documentation/current#getChartRangeRequest)

Returns chart info from the start date to the current time.

```PHP
use Timirey\XApi\Responses\GetChartRangeRequestResponse;
use Timirey\XApi\Client;
use Timirey\XApi\Payloads\Data\ChartRangeInfoRecord;
use Timirey\XApi\Enums\Period;
use DateTime;

$chartRangeInfoRecord = new ChartRangeInfoRecord(
    period: Period::PERIOD_H1,
    start: new DateTime('-1 month'),
    end: new DateTime(),
    symbol: 'EURUSD',
    ticks: 1000
);

/** 
 * @var GetChartRangeRequestResponse $response 
 * @var Client $client
 */
$response = $client->getChartRangeRequest(
    chartRangeInfoRecord: $chartRangeInfoRecord
);
```

### [getCommissionDef](http://developers.xstore.pro/documentation/current#getCommissionDef)

Returns the calculation of commission and rate of exchange.

```PHP
use Timirey\XApi\Responses\GetCommissionDefResponse;
use Timirey\XApi\Client;

/** 
 * @var GetCommissionDefResponse $response 
 * @var Client $client
 */
$response = $client->getCommissionDef(
    symbol: 'EURUSD',
    volume: 1.0
);
```

### [getCurrentUserData](http://developers.xstore.pro/documentation/current#getCurrentUserData)

Returns information about account currency and leverage.

```PHP
use Timirey\XApi\Responses\GetCurrentUserDataResponse;
use Timirey\XApi\Client;

/** 
 * @var GetCurrentUserDataResponse $response 
 * @var Client $client
 */
$response = $client->getCurrentUserData();
```

### [getIbsHistory](http://developers.xstore.pro/documentation/current#getIbsHistory)

Returns IBs data from the given time range.

```PHP
use Timirey\XApi\Responses\GetIbsHistoryResponse;
use Timirey\XApi\Client;
use DateTime;

/** 
 * @var GetIbsHistoryResponse $response 
 * @var Client $client
 */
$response = $client->getIbsHistory(
    start: new DateTime('-1 month'),
    end: new DateTime()
);
```

### [getMarginLevel](http://developers.xstore.pro/documentation/current#getMarginLevel)

Returns various account indicators.

```PHP
use Timirey\XApi\Responses\GetMarginLevelResponse;
use Timirey\XApi\Client;

/** 
 * @var GetMarginLevelResponse $response 
 * @var Client $client
 */
$response = $client->getMarginLevel();
```

### [getMarginTrade](http://developers.xstore.pro/documentation/current#getMarginTrade)

Returns expected margin for a given instrument and volume.

```PHP
use Timirey\XApi\Responses\GetMarginTradeResponse;
use Timirey\XApi\Client;

/** 
 * @var GetMarginTradeResponse $response 
 * @var Client $client
 */
$response = $client->getMarginTrade(
    symbol: 'EURPLN', 
    volume: 1.0
);
```

### [getNews](http://developers.xstore.pro/documentation/current#getNews)

Returns news from the trading server which were sent within a specified period.

```PHP
use Timirey\XApi\Responses\GetNewsResponse;
use Timirey\XApi\Client;
use DateTime;

/** 
 * @var GetNewsResponse $response 
 * @var Client $client
 */
$response = $client->getNews(
    start: new DateTime('-1 month'), 
    end: new DateTime()
);
```

### [getProfitCalculation](http://developers.xstore.pro/documentation/current#getProfitCalculation)

Calculates estimated profit for given deal data.

```PHP
use Timirey\XApi\Responses\GetProfitCalculationResponse;
use Timirey\XApi\Client;
use Timirey\XApi\Enums\Cmd;

/** 
 * @var GetProfitCalculationResponse $response 
 * @var Client $client
 */
$response = $client->getProfitCalculation(
  closePrice: 1.3000, 
  cmd: Cmd::BUY, 
  openPrice: 1.2233, 
  symbol: 'EURPLN', 
  volume: 1.0
);
```

### [getServerTime](http://developers.xstore.pro/documentation/current#getServerTime)

Returns the current time on the trading server.

```PHP
use Timirey\XApi\Responses\GetServerTimeResponse;
use Timirey\XApi\Client;

/** 
 * @var GetServerTimeResponse $response 
 * @var Client $client
 */
$response = $client->getServerTime();
```

### [getStepRules](http://developers.xstore.pro/documentation/current#getStepRules)

Returns a list of step rules for DMAs.

```PHP
use Timirey\XApi\Responses\GetStepRulesResponse;
use Timirey\XApi\Client;

/** 
 * @var GetStepRulesResponse $response 
 * @var Client $client
 */
$response = $client->getStepRules();
```

### [getSymbol](http://developers.xstore.pro/documentation/current#getSymbol)

Retrieves information about a specific symbol.

```PHP
use Timirey\XApi\Responses\GetSymbolResponse;
use Timirey\XApi\Client;

/** 
 * @var GetSymbolResponse $response 
 * @var Client $client
 */
$response = $client->getSymbol(
    symbol: EURUSD
);
```

### [getTickPrices](http://developers.xstore.pro/documentation/current#getTickPrices)

Returns an array of current quotations for given symbols.

```PHP
use Timirey\XApi\Responses\GetTickPricesResponse;
use Timirey\XApi\Enums\Level;
use Timirey\XApi\Client;
use DateTime;

/**
 * @var GetTickPricesResponse $response
 * @var Client $client
 */
$response = $client->getTickPrices(
    level: Level::BASE, 
    symbols: ['EURPLN', 'AGO.PL'], 
    timestamp: new DateTime()
);
```

### [getTradeRecords](http://developers.xstore.pro/documentation/current#getTradeRecords)

Returns an array of trades listed in orders argument.

```PHP
use Timirey\XApi\Responses\GetTradeRecordsResponse;
use Timirey\XApi\Client;

/** 
 * @var GetTradeRecordsResponse $response 
 * @var Client $client
 */
$response = $client->getTradeRecords(
    orders: [7489839, 7489841]
);
```

### [getTrades](http://developers.xstore.pro/documentation/current#getTrades)

Returns an array of user's trades.

```PHP
use Timirey\XApi\Responses\GetTradesResponse;
use Timirey\XApi\Client;

/** 
 * @var GetTradesResponse $response 
 * @var Client $client
 */
$response = $client->getTrades(
    openedOnly: true
);
```

### [getTradesHistory](http://developers.xstore.pro/documentation/current#getTradesHistory)

Returns an array of user's trades which were closed within a specified period.

```PHP
use Timirey\XApi\Responses\GetTradesHistoryResponse;
use Timirey\XApi\Client;
use DateTime;

/** 
 * @var GetTradesHistoryResponse $response 
 * @var Client $client
 */
$response = $client->getTradesHistory(
    start: new DateTime('last month'), 
    end: new DateTime()
);
```

### [getTradingHours](http://developers.xstore.pro/documentation/current#getTradingHours)

Returns quotes and trading times.

```PHP
use Timirey\XApi\Responses\GetTradingHoursResponse;
use Timirey\XApi\Client;

/** 
 * @var GetTradingHoursResponse $response 
 * @var Client $client
 */
$response = $client->getTradingHours(
    symbols: ['EURPLN', 'AGO.PL']
);
```

### [getVersion](http://developers.xstore.pro/documentation/current#getVersion)

Returns the current API version.

```PHP
use Timirey\XApi\Responses\GetVersionResponse;
use Timirey\XApi\Client;

/** 
 * @var GetVersionResponse $response 
 * @var Client $client
 */
$response = $client->getVersion();
```

### [ping](http://developers.xstore.pro/documentation/current#ping)

Regularly calling this function is enough to refresh the internal state of all the components in the system.

```PHP
use Timirey\XApi\Responses\PingResponse;
use Timirey\XApi\Client;

/** 
 * @var PingResponse $response 
 * @var Client $client
 */
$response = $client->ping();
```

### [tradeTransaction](http://developers.xstore.pro/documentation/current#tradeTransaction)

Starts a trade transaction.

```PHP
use Timirey\XApi\Responses\TradeTransactionResponse;
use Timirey\XApi\Payloads\Data\TradeTransInfo;
use Timirey\XApi\Client;

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

/** 
 * @var TradeTransactionResponse $response 
 * @var Client $client
 */
$response = $client->tradeTransaction(
    tradeTransInfo: $tradeTransInfo
);
```

### [tradeTransactionStatus](http://developers.xstore.pro/documentation/current#tradeTransactionStatus)

Returns the current transaction status.

```PHP
use Timirey\XApi\Responses\TradeTransactionStatusResponse;
use Timirey\XApi\Client;

/** 
 * @var TradeTransactionStatusResponse $response 
 * @var Client $client
 */
$response = $client->tradeTransactionStatus(
    order: 123456
);
```

## Error handling

Custom exceptions for handling request errors.

### ErrorResponseException

Thrown when the API returns an error (e.g., invalid password). Provides error code and description.

```PHP
use Timirey\XApi\Exceptions\ResponseException;
use Timirey\XApi\Enums\Host;
use Timirey\XApi\Client;

/** 
 * @var Client $client 
 */
$client = new Client(
    userId: 123456789, 
    password: 'invalidPassword', 
    host: Host::DEMO
);

try {
    $client->getVersion();
} catch (ErrorResponseException $e) {
    echo ($e->getErrorCode()); // 'BE005'
    echo ($e->getErrorDescr()); // 'userPasswordCheck: Invalid login or password.'
}
```

All error codes and descriptions can be found in
the [official documentation](http://developers.xstore.pro/documentation#error-messages).

### InvalidResponseException

Thrown when a request fails and the API does not return a proper error response (e.g., invalid or incomplete response).

### InvalidPayloadException

Thrown when for some reason the payload is invalid (usually invalid response from the xApi).

### SocketException

Thrown when socket fails to connect/read/write for some reason.

## Testing

This package uses the PestPHP framework for testing.

```SH
./vendor/bin/pest
```

## License

This library is open-sourced software licensed under
the [MIT license](https://github.com/timirey/xapi-php/blob/main/LICENSE.md).

## Reference

For more detailed documentation, please refer to
the [XTB xStation5 Trading API Documentation](http://developers.xstore.pro/documentation).
