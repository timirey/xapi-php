![xStore Developers](https://github.com/timirey/xapi-php/assets/15349915/8f2f6b27-29d6-487d-bbcc-bea2befebd5b)

This PHP library provides a comprehensive and user-friendly interface for interacting with the X-Trade Brokers (XTB) xStation5 Trading API. It supports various functionalities including account management, trade execution, and market data retrieval.

## Table of Contents

- [Installation](#installation)
- [Usage](#usage)
- [Available Commands](#available-commands)
  - [login](#login)
  - [logout](#logout)
- [Retrieving trading data](#retrieving-trading-data)
  - [getStepRules](#getsteprules)
  - [getTickPrices](#gettickprices)
  - [getTrades](#gettrades)
  - [getTradesHistory](#gettradeshistory)
  - [getTradingHours](#gettradinghours)
  - [getVersion](#getversion)
  - [getProfitCalculation](#getprofitcalculation)
  - [getServerTime](#getservertime)
  - [getMarginTrade](#getmargintrade)
  - [getIbsHistory](#getibshistory)
  - [getNews](#getnews)
  - [getCurrentUserData](#getcurrentuserdata)
  - [getMarginLevel](#getmarginlevel)
  - [getSymbol](#getsymbol)
  - [getAllSymbols](#getallsymbols)
  - [tradeTransaction](#tradetransaction)
  - [tradeTransactionStatus](#tradetransactionstatus)
  - [ping](#ping)
  - [getCalendar](#getcalendar)
  - [getChartLastRequest](#getchartlastrequest)
  - [getChartRangeRequest](#getchartrangerequest)
  - [getCommissionDef](#getcommissiondef)
  - [getTradeRecords](#gettraderecords)
- [License](#license)

## Installation

Install the package via Composer:

```SH
composer require timirey/xtb-api
```

## Usage

Before you can access the endpoints, you should initialize a client.

```PHP
use Timirey\XApi\Clients\Client;
use Timirey\XApi\Clients\Enums\Host;

$client = new Client($userId, $password, Host::DEMO);
```

And authenticate.

```PHP
$client->login();
```

Now you can send commands.

## Available Commands

Request-Reply commands are performed on main connection socket. The reply is sent by main connection socket.

### [login](http://developers.xstore.pro/documentation/current#login)

Logs in to the xStation5 API.

```PHP
$response = $client->login();
```

### [logout](http://developers.xstore.pro/documentation/current#logout)

Logs out from the xStation5 API.

## Retrieving trading data

Currently, it supports only non-streaming commands. Streaming commands will be released later.

### [getStepRules](http://developers.xstore.pro/documentation/current#getStepRules)

Returns a list of step rules for DMAs.

```PHP
$response = $client->getStepRules();
```

### [getTickPrices](http://developers.xstore.pro/documentation/current#getTickPrices)

Returns an array of current quotations for given symbols.

```PHP
$level = Level::BASE;
$symbols = ['EURPLN', 'AGO.PL'];
$timestamp = new DateTime();
$response = $client->getTickPrices($level, $symbols, $timestamp);
```

### [getTrades](http://developers.xstore.pro/documentation/current#getTrades)

Returns an array of user's trades.

```PHP
$openedOnly = true;
$response = $client->getTrades($openedOnly);
```

### [getTradesHistory](http://developers.xstore.pro/documentation/current#getTradesHistory)

Returns an array of user's trades which were closed within a specified period.

```PHP
$start = new DateTime('last month');
$end = new DateTime();
$response = $client->getTradesHistory($start, $end);
```

### [getTradingHours](http://developers.xstore.pro/documentation/current#getTradingHours)

Returns quotes and trading times.

```PHP
$symbols = ['EURPLN', 'AGO.PL'];
$response = $client->getTradingHours($symbols);
```

### [getVersion](http://developers.xstore.pro/documentation/current#getVersion)

Returns the current API version.

```PHP
$response = $client->getVersion();
```

### [getProfitCalculation](http://developers.xstore.pro/documentation/current#getProfitCalculation)

Calculates estimated profit for given deal data.

```PHP
$closePrice = 1.3000;
$cmd = Cmd::BUY;
$openPrice = 1.2233;
$symbol = 'EURPLN';
$volume = 1.0;
$response = $client->getProfitCalculation($closePrice, $cmd, $openPrice, $symbol, $volume);
```

### [getServerTime](http://developers.xstore.pro/documentation/current#getServerTime)

Returns the current time on the trading server.

```PHP
$response = $client->getServerTime();
```

### [getMarginTrade](http://developers.xstore.pro/documentation/current#getMarginTrade)

Returns expected margin for a given instrument and volume.

```PHP
$symbol = 'EURPLN';
$volume = 1.0;
$response = $client->getMarginTrade($symbol, $volume);
```

### [getIbsHistory](http://developers.xstore.pro/documentation/current#getIbsHistory)

Returns IBs data from the given time range.

```PHP
$start = new DateTime('-1 month');
$end = new DateTime();
$response = $client->getIbsHistory($start, $end);
```

### [getNews](http://developers.xstore.pro/documentation/current#getNews)

Returns news from the trading server which were sent within a specified period.

```PHP
$start = new DateTime('-1 month');
$end = new DateTime();
$response = $client->getNews($start, $end);
```

### [getCurrentUserData](http://developers.xstore.pro/documentation/current#getCurrentUserData)

Returns information about account currency and leverage.

```PHP
$response = $client->getCurrentUserData();
```

### [getMarginLevel](http://developers.xstore.pro/documentation/current#getMarginLevel)

Returns various account indicators.

```PHP
$response = $client->getMarginLevel();
```

```PHP
$response = $client->logout();
```

### [getSymbol](http://developers.xstore.pro/documentation/current#getSymbol)

Retrieves information about a specific symbol.

```PHP
$symbol = 'EURUSD';
$response = $client->getSymbol($symbol);
```

### [getAllSymbols](http://developers.xstore.pro/documentation/current#getAllSymbols)

Retrieves information about all symbols.

```PHP
$response = $client->getAllSymbols();
```

### [tradeTransaction](http://developers.xstore.pro/documentation/current#tradeTransaction)

Starts a trade transaction.

```PHP
$tradeTransInfo = new TradeTransInfo(/* parameters */);
$response = $client->tradeTransaction($tradeTransInfo);
```

### [tradeTransactionStatus](http://developers.xstore.pro/documentation/current#tradeTransactionStatus)

Returns the current transaction status.

```PHP
$order = 123456;
$response = $client->tradeTransactionStatus($order);
```

### [ping](http://developers.xstore.pro/documentation/current#ping)

Regularly calling this function is enough to refresh the internal state of all the components in the system.

```PHP
$response = $client->ping();
```

### [getCalendar](http://developers.xstore.pro/documentation/current#getCalendar)

Returns a calendar with market events.

```PHP
$response = $client->getCalendar();
```

### [getChartLastRequest](http://developers.xstore.pro/documentation/current#getChartLastRequest)

Returns chart info from the start date to the current time.

```PHP
$chartLastInfoRecord = new ChartLastInfoRecord(/* parameters */);
$response = $client->getChartLastRequest($chartLastInfoRecord);
```

### [getChartRangeRequest](http://developers.xstore.pro/documentation/current#getChartRangeRequest)

Returns chart info from the start date to the current time.

```PHP
$chartRangeInfoRecord = new ChartRangeInfoRecord(/* parameters */);
$response = $client->getChartRangeRequest($chartRangeInfoRecord);
```

### [getCommissionDef](http://developers.xstore.pro/documentation/current#getCommissionDef)

Returns the calculation of commission and rate of exchange.

```PHP
$symbol = 'EURUSD';
$volume = 1.0;
$response = $client->getCommissionDef($symbol, $volume);
```

### [getTradeRecords](http://developers.xstore.pro/documentation/current#getTradeRecords)

Returns an array of trades listed in orders argument.

```PHP
$orders = [7489839, 7489841];
$response = $client->getTradeRecords($orders);
```

## License

This library is open-sourced software licensed under the [MIT license](LICENSE).

## Reference

For more detailed documentation, please refer to the [XTB xStation5 Trading API Documentation](http://developers.xstore.pro/documentation).
