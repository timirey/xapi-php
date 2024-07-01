![xStore Developers](http://developers.xstore.pro/public/img/logo.png)

## About PHP xAPI

This PHP library provides a comprehensive and easy-to-use interface for interacting with the X-Trade Brokers (XTB) xStation5 Trading API. It supports various functionalities including account management, trade execution, and market data retrieval.

## Installation

Install the package via Composer:

```sh
composer require timirey/xtb-api
```

## Usage

Before you can access the endpoints, you should init a client.

```PHP
use Timirey\XApi\Clients\Client;
use Timirey\XApi\Clients\Enums\Host;

/**
 * @var Timirey\XApi\Clients\Client $client
 */
$client = new Client($userId, $password, Host::DEMO);
```

And authenticate.

```PHP
/**
 * @var Timirey\XApi\Responses\LoginResponse $response
 */
$response = $client->login();
```

Now you can send commands.

```PHP
/**
 * @var Timirey\XApi\Responses\GetAllSymbolsResponse $response
 */
$response = $client->getAllSymbols();
```

## Available Commands

Request-Reply commands are performed on main connection socket. The reply is sent by main connection socket.


### Command: [login](http://developers.xstore.pro/documentation/current#login)

Logs in to the xStation5 API.

```PHP
/**
 * @var Timirey\XApi\Responses\LoginResponse $response
 */
$response = $client->login();
```
___

### Command: [logout](http://developers.xstore.pro/documentation/current#logout)

Logs out from the xStation5 API.

```PHP
/**
 * @var Timirey\XApi\Responses\LogoutResponse $response
 */
$response = $client->logout();
```

## Retrieving Trading Data

Currently it supports only non streaming commands. Streamming commands will be release later.

### Command: [getStepRules](http://developers.xstore.pro/documentation/current#getStepRules)

Returns a list of step rules for DMAs.

```PHP
/**
 * @var Timirey\XApi\Responses\GetStepRulesResponse $response
 */
$response = $client->getStepRules();
```
___

### Command: [getTickPrices](http://developers.xstore.pro/documentation/current#getTickPrices)

Returns an array of current quotations for given symbols.

```PHP
$level = Level::BASE;
$symbols = ['EURPLN', 'AGO.PL'];
$timestamp = new DateTime();

/**
 * @var Timirey\XApi\Responses\GetTickPricesResponse $response
 */
$response = $client->getTickPrices($level, $symbols, $timestamp);
```
___

### Command: [getTrades](http://developers.xstore.pro/documentation/current#getTrades)

Returns an array of user's trades.

```PHP
$openedOnly = true;

/**
 * @var Timirey\XApi\Responses\GetTradesResponse $response
 */
$response = $client->getTrades($openedOnly);
```
___

### Command: [getTradesHistory](http://developers.xstore.pro/documentation/current#getTradesHistory)

Returns an array of user's trades which were closed within a specified period.

```PHP
$start = new DateTime('last month');
$end = new DateTime();

/**
 * @var Timirey\XApi\Responses\GetTradesHistoryResponse $response
 */
$response = $client->getTradesHistory($start, $end);
```
___

### Command: [getTradingHours](http://developers.xstore.pro/documentation/current#getTradingHours)

Returns quotes and trading times.

```PHP
$symbols = ['EURPLN', 'AGO.PL'];

/**
 * @var Timirey\XApi\Responses\GetTradingHoursResponse $response
 */
$response = $client->getTradingHours($symbols);
```
___

### Command: [getVersion](http://developers.xstore.pro/documentation/current#getVersion)

Returns the current API version.

```PHP
/**
 * @var Timirey\XApi\Responses\GetVersionResponse $response
 */
$response = $client->getVersion();
```
___

### Command: [getProfitCalculation](http://developers.xstore.pro/documentation/current#getProfitCalculation)

Calculates estimated profit for given deal data.

```PHP
$closePrice = 1.3000;
$cmd = Cmd::BUY;
$openPrice = 1.2233;
$symbol = 'EURPLN';
$volume = 1.0;

/**
 * @var Timirey\XApi\Responses\GetProfitCalculationResponse $response
 */
$response = $client->getProfitCalculation($closePrice, $cmd, $openPrice, $symbol, $volume);
```
___

### Command: [getServerTime](http://developers.xstore.pro/documentation/current#getServerTime)

Returns the current time on the trading server.

```PHP
/**
 * @var Timirey\XApi\Responses\GetServerTimeResponse $response
 */
$response = $client->getServerTime();
```
___

### Command: [getMarginTrade](http://developers.xstore.pro/documentation/current#getMarginTrade)

Returns expected margin for a given instrument and volume.

```PHP
$symbol = 'EURPLN';
$volume = 1.0;

/**
 * @var Timirey\XApi\Responses\GetMarginTradeResponse $response
 */
$response = $client->getMarginTrade($symbol, $volume);
```
___

### Command: [getIbsHistory](http://developers.xstore.pro/documentation/current#getIbsHistory)

Returns IBs data from the given time range.

```PHP
$start = new DateTime('-1 month');
$end = new DateTime();

/**
 * @var Timirey\XApi\Responses\GetIbsHistoryResponse $response
 */
$response = $client->getIbsHistory($start, $end);
```
___

### Command: [getNews](http://developers.xstore.pro/documentation/current#getNews)

Returns news from the trading server which were sent within a specified period.

```PHP
$start = new DateTime('-1 month');
$end = new DateTime();

/**
 * @var Timirey\XApi\Responses\GetNewsResponse $response
 */
$response = $client->getNews($start, $end);
```
___

### Command: [getCurrentUserData](http://developers.xstore.pro/documentation/current#getCurrentUserData)

Returns information about account currency and leverage.

```PHP
/**
 * @var Timirey\XApi\Responses\GetCurrentUserDataResponse $response
 */
$response = $client->getCurrentUserData();
```
___

### Command: [getMarginLevel](http://developers.xstore.pro/documentation/current#getMarginLevel)

Returns various account indicators.

```PHP
/**
 * @var Timirey\XApi\Responses\GetMarginLevelResponse $response
 */
$response = $client->getMarginLevel();
```
___

### Command: [getSymbol](http://developers.xstore.pro/documentation/current#getSymbol)

Retrieves information about a specific symbol.

```PHP
$symbol = 'EURUSD';

/**
 * @var Timirey\XApi\Responses\GetSymbolResponse $response
 */
$response = $client->getSymbol($symbol);
```
___

### Command: [getAllSymbols](http://developers.xstore.pro/documentation/current#getAllSymbols)

Retrieves information about all symbols.

```PHP
/**
 * @var Timirey\XApi\Responses\GetAllSymbolsResponse $response
 */
$response = $client->getAllSymbols();
```
___

### Command: [tradeTransaction](http://developers.xstore.pro/documentation/current#tradeTransaction)

Starts a trade transaction.

```PHP
$tradeTransInfo = new TradeTransInfo(/* parameters */);

/**
 * @var Timirey\XApi\Responses\TradeTransactionResponse $response
 */
$response = $client->tradeTransaction($tradeTransInfo);
```
___

### Command: [tradeTransactionStatus](http://developers.xstore.pro/documentation/current#tradeTransactionStatus)

Returns the current transaction status.

```PHP
$order = 123456;

/**
 * @var Timirey\XApi\Responses\TradeTransactionStatusResponse $response
 */
$response = $client->tradeTransactionStatus($order);
```
___

### Command: [ping](http://developers.xstore.pro/documentation/current#ping)

Regularly calling this function is enough to refresh the internal state of all the components in the system.

```PHP
/**
 * @var Timirey\XApi\Responses\PingResponse $response
 */
$response = $client->ping();
```
___

### Command: [getCalendar](http://developers.xstore.pro/documentation/current#getCalendar)

Returns a calendar with market events.

```PHP
/**
 * @var Timirey\XApi\Responses\GetCalendarResponse $response
 */
$response = $client->getCalendar();
```
___

### Command: [getChartLastRequest](http://developers.xstore.pro/documentation/current#getChartLastRequest)

Returns chart info from the start date to the current time.

```PHP
$chartLastInfoRecord = new ChartLastInfoRecord(/* parameters */);

/**
 * @var Timirey\XApi\Responses\GetChartLastRequestResponse $response
 */
$response = $client->getChartLastRequest($chartLastInfoRecord);
```
___

### Command: [getChartRangeRequest](http://developers.xstore.pro/documentation/current#getChartRangeRequest)

Returns chart info from the start date to the current time.

```PHP
$chartRangeInfoRecord = new ChartRangeInfoRecord(/* parameters */);

/**
 * @var Timirey\XApi\Responses\GetChartRangeRequestResponse $response
 */
$response = $client->getChartRangeRequest($chartRangeInfoRecord);
```
___

### Command: [getCommissionDef](http://developers.xstore.pro/documentation/current#getCommissionDef)

Returns the calculation of commission and rate of exchange.

```PHP
$symbol = 'EURUSD';
$volume = 1.0;

/**
 * @var Timirey\XApi\Responses\GetCommissionDefResponse $response
 */
$response = $client->getCommissionDef($symbol, $volume);
```
___

### Command: [getTradeRecords](http://developers.xstore.pro/documentation/current#getTradeRecords)

Returns an array of trades listed in orders argument.

```PHP
$orders = [7489839, 7489841];

/**
 * @var Timirey\XApi\Responses\GetTradeRecordsResponse $response
 */
$response = $client->getTradeRecords($orders);
```