![xStore Developers](http://developers.xstore.pro/public/img/logo.png)

## About xAPI PHP

This PHP library provides a comprehensive and easy-to-use interface for interacting with the X-Trade Brokers (XTB) xStation5 Trading API. It supports various functionalities including account management, trade execution, and market data retrieval.

## Installation

Install the package via Composer:

```sh
composer require timirey/xapi-php
```

## Usage

Before you can access the endpoints, you should init a client.

```PHP
use Timirey\XApi\Clients\Client;
use Timirey\XApi\Clients\Enums\Host;

$userId = 123456789;
$password = 'password';

/** @var Client $client */
$client = new Client($userId, $password, Host::DEMO);
```

And authenticate.

```PHP
use Timirey\XApi\Responses\LoginResponse;

/** @var LoginResponse $response */
$response = $client->login();
```

Now you can send commands.

```PHP
use Timirey\XApi\Responses\GetAllSymbolsResponse;

/** @var GetAllSymbolsResponse $response */
$response = $client->getAllSymbols();
```

## Available Commands

Request-Reply commands are performed on main connection socket. The reply is sent by main connection socket.


### Command: [login](http://developers.xstore.pro/documentation/current#login)

Logs in to the xStation5 API.

```PHP
use Timirey\XApi\Responses\LoginResponse;

/** @var LoginResponse $response */
$response = $client->login();
```
___

### Command: [logout](http://developers.xstore.pro/documentation/current#logout)

Logs out from the xStation5 API.

```PHP
use Timirey\XApi\Responses\LogoutResponse;

/** @var LogoutResponse $response */
$response = $client->logout();
```

## Retrieving Trading Data

Currently it supports only non streaming commands. Streamming commands will be release later.

### Command: [getStepRules](http://developers.xstore.pro/documentation/current#getStepRules)

Returns a list of step rules for DMAs.

```PHP
use Timirey\XApi\Responses\GetStepRulesResponse;

/** @var GetStepRulesResponse $response */
$response = $client->getStepRules();
```
___

### Command: [getTickPrices](http://developers.xstore.pro/documentation/current#getTickPrices)

Returns an array of current quotations for given symbols.

```PHP
use Timirey\XApi\Responses\GetTickPricesResponse;
use Timirey\XApi\Enums\Level;
use DateTime;

$level = Level::BASE;
$symbols = ['EURPLN', 'AGO.PL'];
$timestamp = new DateTime();

/** @var GetTickPricesResponse $response */
$response = $client->getTickPrices($level, $symbols, $timestamp);
```
___

### Command: [getTrades](http://developers.xstore.pro/documentation/current#getTrades)

Returns an array of user's trades.

```PHP
use Timirey\XApi\Responses\GetTradesResponse;

$openedOnly = true;

/** @var GetTradesResponse $response */
$response = $client->getTrades($openedOnly);
```
___

### Command: [getTradesHistory](http://developers.xstore.pro/documentation/current#getTradesHistory)

Returns an array of user's trades which were closed within a specified period.

```PHP
use Timirey\XApi\Responses\GetTradesHistoryResponse;
use DateTime;

$start = new DateTime('last month');
$end = new DateTime();

/** @var GetTradesHistoryResponse $response */
$response = $client->getTradesHistory($start, $end);
```
___

### Command: [getTradingHours](http://developers.xstore.pro/documentation/current#getTradingHours)

Returns quotes and trading times.

```PHP
use Timirey\XApi\Responses\GetTradingHoursResponse;

$symbols = ['EURPLN', 'AGO.PL'];

/** @var GetTradingHoursResponse $response */
$response = $client->getTradingHours($symbols);
```
___

### Command: [getVersion](http://developers.xstore.pro/documentation/current#getVersion)

Returns the current API version.

```PHP
use Timirey\XApi\Responses\GetVersionResponse;

/** @var GetVersionResponse $response */
$response = $client->getVersion();
```
___

### Command: [getProfitCalculation](http://developers.xstore.pro/documentation/current#getProfitCalculation)

Calculates estimated profit for given deal data.

```PHP
use Timirey\XApi\Responses\GetProfitCalculationResponse;
use Timirey\XApi\Enums\Cmd;

$closePrice = 1.3000;
$cmd = Cmd::BUY;
$openPrice = 1.2233;
$symbol = 'EURPLN';
$volume = 1.0;

/** @var GetProfitCalculationResponse $response */
$response = $client->getProfitCalculation($closePrice, $cmd, $openPrice, $symbol, $volume);
```
___

### Command: [getServerTime](http://developers.xstore.pro/documentation/current#getServerTime)

Returns the current time on the trading server.

```PHP
use Timirey\XApi\Responses\GetServerTimeResponse;

/** @var GetServerTimeResponse $response */
$response = $client->getServerTime();
```
___

### Command: [getMarginTrade](http://developers.xstore.pro/documentation/current#getMarginTrade)

Returns expected margin for a given instrument and volume.

```PHP
use Timirey\XApi\Responses\GetMarginTradeResponse;

$symbol = 'EURPLN';
$volume = 1.0;

/** @var GetMarginTradeResponse $response */
$response = $client->getMarginTrade($symbol, $volume);
```
___

### Command: [getIbsHistory](http://developers.xstore.pro/documentation/current#getIbsHistory)

Returns IBs data from the given time range.

```PHP
use Timirey\XApi\Responses\GetIbsHistoryResponse;
use DateTime;

$start = new DateTime('-1 month');
$end = new DateTime();

/** @var GetIbsHistoryResponse $response */
$response = $client->getIbsHistory($start, $end);
```
___

### Command: [getNews](http://developers.xstore.pro/documentation/current#getNews)

Returns news from the trading server which were sent within a specified period.

```PHP
use Timirey\XApi\Responses\GetNewsResponse;
use DateTime;

$start = new DateTime('-1 month');
$end = new DateTime();

/** @var GetNewsResponse $response */
$response = $client->getNews($start, $end);
```
___

### Command: [getCurrentUserData](http://developers.xstore.pro/documentation/current#getCurrentUserData)

Returns information about account currency and leverage.

```PHP
use Timirey\XApi\Responses\GetCurrentUserDataResponse;

/** @var GetCurrentUserDataResponse $response */
$response = $client->getCurrentUserData();
```
___

### Command: [getMarginLevel](http://developers.xstore.pro/documentation/current#getMarginLevel)

Returns various account indicators.

```PHP
use Timirey\XApi\Responses\GetMarginLevelResponse;

/** @var GetMarginLevelResponse $response */
$response = $client->getMarginLevel();
```
___

### Command: [getSymbol](http://developers.xstore.pro/documentation/current#getSymbol)

Retrieves information about a specific symbol.

```PHP
use Timirey\XApi\Responses\GetSymbolResponse;

$symbol = 'EURUSD';

/** @var GetSymbolResponse $response */
$response = $client->getSymbol($symbol);
```
___

### Command: [getAllSymbols](http://developers.xstore.pro/documentation/current#getAllSymbols)

Retrieves information about all symbols.

```PHP
use Timirey\XApi\Responses\GetAllSymbolsResponse;

/** @var GetAllSymbolsResponse $response */
$response = $client->getAllSymbols();
```
___

### Command: [tradeTransaction](http://developers.xstore.pro/documentation/current#tradeTransaction)

Starts a trade transaction.

```PHP
use Timirey\XApi\Payloads\Data\TradeTransInfo;
use Timirey\XApi\Responses\TradeTransactionResponse;

$tradeTransInfo = new TradeTransInfo(/* parameters */);

/** @var TradeTransactionResponse $response */
$response = $client->tradeTransaction($tradeTransInfo);
```
___

### Command: [tradeTransactionStatus](http://developers.xstore.pro/documentation/current#tradeTransactionStatus)

Returns the current transaction status.

```PHP
use Timirey\XApi\Responses\TradeTransactionStatusResponse;

$order = 123456;

/** @var TradeTransactionStatusResponse $response */
$response = $client->tradeTransactionStatus($order);
```
___

### Command: [ping](http://developers.xstore.pro/documentation/current#ping)

Regularly calling this function is enough to refresh the internal state of all the components in the system.

```PHP
use Timirey\XApi\Responses\PingResponse;

/** @var PingResponse $response */
$response = $client->ping();
```
___

### Command: [getCalendar](http://developers.xstore.pro/documentation/current#getCalendar)

Returns a calendar with market events.

```PHP
use Timirey\XApi\Responses\GetCalendarResponse;

/** @var GetCalendarResponse $response */
$response = $client->getCalendar();
```
___

### Command: [getChartLastRequest](http://developers.xstore.pro/documentation/current#getChartLastRequest)

Returns chart info from the start date to the current time.

```PHP
use Timirey\XApi\Responses\GetChartLastRequestResponse;
use Timirey\XApi\Payloads\Data\ChartLastInfoRecord;

$chartLastInfoRecord = new ChartLastInfoRecord(/* parameters */);

/** @var GetChartLastRequestResponse $response */
$response = $client->getChartLastRequest($chartLastInfoRecord);
```
___

### Command: [getChartRangeRequest](http://developers.xstore.pro/documentation/current#getChartRangeRequest)

Returns chart info from the start date to the current time.

```PHP
use Timirey\XApi\Responses\GetChartRangeRequestResponse;
use Timirey\XApi\Payloads\Data\ChartRangeInfoRecord;

$chartRangeInfoRecord = new ChartRangeInfoRecord(/* parameters */);

/** @var GetChartRangeRequestResponse $response */
$response = $client->getChartRangeRequest($chartRangeInfoRecord);
```
___

### Command: [getCommissionDef](http://developers.xstore.pro/documentation/current#getCommissionDef)

Returns the calculation of commission and rate of exchange.

```PHP
use Timirey\XApi\Responses\GetCommissionDefResponse;

$symbol = 'EURUSD';
$volume = 1.0;

/** @var GetCommissionDefResponse $response */
$response = $client->getCommissionDef($symbol, $volume);
```
___

### Command: [getTradeRecords](http://developers.xstore.pro/documentation/current#getTradeRecords)

Returns an array of trades listed in orders argument.

```PHP
use Timirey\XApi\Responses\GetTradeRecordsResponse;

$orders = [7489839, 7489841];

/** @var GetTradeRecordsResponse $response */
$response = $client->getTradeRecords($orders);
```


Table of contents, error handling