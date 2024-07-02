<p align="center">
<img src="https://raw.githubusercontent.com/timirey/xapi-php/main/.github/logo.png" alt="xStore Developers">
</p>

<p align="center">
<a href="https://github.com/timirey/xapi-php/actions"><img src="https://github.com/timirey/xapi-php/actions/workflows/tests.yml/badge.svg" alt="Tests"></a>
<a href="https://packagist.org/packages/timirey/xapi-php"><img src="https://img.shields.io/packagist/v/timirey/xapi-php" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/timirey/xapi-php"><img src="https://img.shields.io/packagist/l/timirey/xapi-php" alt="License"></a>
</p>

This PHP library provides a comprehensive and user-friendly interface for interacting with the X-Trade Brokers (XTB)
xStation5 Trading API. It supports various functionalities including account management, trade execution, and market
data retrieval.

## Table of Contents

- [Installation](#installation)
- [Usage](#usage)
- [Available commands](#available-commands)
    - [login](#login)
    - [logout](#logout)
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
- [Error messages](#error-messages)
- [License](#license)
- [Reference](#reference)

## Installation

Install the package via Composer.

```SH
composer require timirey/xapi-php
```

## Usage

Initialize the client.

```PHP
use Timirey\XApi\Client;
use Timirey\XApi\Enums\Host;

/** 
 * @var Client $client 
 */
$client = new Client(
    userId: 123456789, 
    password: 'password', 
    host: Host::DEMO
);
```

Authenticate.

```PHP
use Timirey\XApi\Responses\LoginResponse;
use Timirey\XApi\Client;

/** 
 * @var LoginResponse $response 
 * @var Client $client
 */
$response = $client->login();
```

Send commands.

```PHP
use Timirey\XApi\Responses\GetAllSymbolsResponse;
use Timirey\XApi\Client;

/** 
 * @var GetAllSymbolsResponse $response 
 * @var Client $client
 */
$response = $client->getAllSymbols();
```

Logout when done.

```PHP
use Timirey\XApi\Responses\LogoutResponse;
use Timirey\XApi\Client;

/** 
 * @var LogoutResponse $response 
 * @var Client $client
 */
$response = $client->logout();
```

## Available Commands

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
$response = $client->login();
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

## Retrieving trading data

Only non-streaming commands are supported at this time. Streaming commands will be introduced in a future update.

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

## Error messages

If any request fails, it will throw an instance of ResponseException.

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
    $client->login();
} catch (ResponseException $e) {
    echo ($e->getErrorCode()); // 'BE005'
    echo ($e->getErrorDescr()); // 'userPasswordCheck: Invalid login or password.'
}
```

All error codes and descriptions can be found in the [official documentation](http://developers.xstore.pro/documentation#error-messages).

## License

This library is open-sourced software licensed under the [MIT license](LICENSE).

## Reference

For more detailed documentation, please refer to
the [XTB xStation5 Trading API Documentation](http://developers.xstore.pro/documentation).
