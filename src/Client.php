<?php

namespace Timirey\XApi;

use DateTime;
use JsonException;
use Timirey\XApi\Connections\SocketConnection;
use Timirey\XApi\Enums\Cmd;
use Timirey\XApi\Enums\Host;
use Timirey\XApi\Enums\Level;
use Timirey\XApi\Exceptions\ErrorResponseException;
use Timirey\XApi\Exceptions\InvalidPayloadException;
use Timirey\XApi\Exceptions\InvalidResponseException;
use Timirey\XApi\Exceptions\SocketException;
use Timirey\XApi\Payloads\AbstractPayload;
use Timirey\XApi\Payloads\AbstractStreamPayload;
use Timirey\XApi\Payloads\Data\ChartLastInfoRecord;
use Timirey\XApi\Payloads\Data\ChartRangeInfoRecord;
use Timirey\XApi\Payloads\Data\TradeTransInfo;
use Timirey\XApi\Payloads\GetAllSymbolsPayload;
use Timirey\XApi\Payloads\FetchBalancePayload;
use Timirey\XApi\Payloads\GetCalendarPayload;
use Timirey\XApi\Payloads\FetchCandlesPayload;
use Timirey\XApi\Payloads\GetChartLastRequestPayload;
use Timirey\XApi\Payloads\GetChartRangeRequestPayload;
use Timirey\XApi\Payloads\GetCommissionDefPayload;
use Timirey\XApi\Payloads\GetCurrentUserDataPayload;
use Timirey\XApi\Payloads\GetIbsHistoryPayload;
use Timirey\XApi\Payloads\FetchKeepAlivePayload;
use Timirey\XApi\Payloads\GetMarginLevelPayload;
use Timirey\XApi\Payloads\GetMarginTradePayload;
use Timirey\XApi\Payloads\GetNewsPayload;
use Timirey\XApi\Payloads\FetchNewsPayload;
use Timirey\XApi\Payloads\GetProfitCalculationPayload;
use Timirey\XApi\Payloads\FetchProfitsPayload;
use Timirey\XApi\Payloads\GetServerTimePayload;
use Timirey\XApi\Payloads\GetStepRulesPayload;
use Timirey\XApi\Payloads\GetSymbolPayload;
use Timirey\XApi\Payloads\GetTickPricesPayload;
use Timirey\XApi\Payloads\FetchTickPricesPayload;
use Timirey\XApi\Payloads\GetTradeRecordsPayload;
use Timirey\XApi\Payloads\GetTradesHistoryPayload;
use Timirey\XApi\Payloads\GetTradesPayload;
use Timirey\XApi\Payloads\FetchTradesPayload;
use Timirey\XApi\Payloads\FetchTradeStatusPayload;
use Timirey\XApi\Payloads\GetTradingHoursPayload;
use Timirey\XApi\Payloads\GetVersionPayload;
use Timirey\XApi\Payloads\LoginPayload;
use Timirey\XApi\Payloads\LogoutPayload;
use Timirey\XApi\Payloads\PingPayload;
use Timirey\XApi\Payloads\PingStreamPayload;
use Timirey\XApi\Payloads\TradeTransactionPayload;
use Timirey\XApi\Payloads\TradeTransactionStatusPayload;
use Timirey\XApi\Responses\AbstractResponse;
use Timirey\XApi\Responses\AbstractStreamResponse;
use Timirey\XApi\Responses\GetAllSymbolsResponse;
use Timirey\XApi\Responses\FetchBalanceResponse;
use Timirey\XApi\Responses\GetCalendarResponse;
use Timirey\XApi\Responses\FetchCandlesResponse;
use Timirey\XApi\Responses\GetChartLastRequestResponse;
use Timirey\XApi\Responses\GetChartRangeRequestResponse;
use Timirey\XApi\Responses\GetCommissionDefResponse;
use Timirey\XApi\Responses\GetCurrentUserDataResponse;
use Timirey\XApi\Responses\GetIbsHistoryResponse;
use Timirey\XApi\Responses\FetchKeepAliveResponse;
use Timirey\XApi\Responses\GetMarginLevelResponse;
use Timirey\XApi\Responses\GetMarginTradeResponse;
use Timirey\XApi\Responses\GetNewsResponse;
use Timirey\XApi\Responses\FetchNewsResponse;
use Timirey\XApi\Responses\GetProfitCalculationResponse;
use Timirey\XApi\Responses\FetchProfitsResponse;
use Timirey\XApi\Responses\GetServerTimeResponse;
use Timirey\XApi\Responses\GetStepRulesResponse;
use Timirey\XApi\Responses\GetSymbolResponse;
use Timirey\XApi\Responses\GetTickPricesResponse;
use Timirey\XApi\Responses\FetchTickPricesResponse;
use Timirey\XApi\Responses\GetTradeRecordsResponse;
use Timirey\XApi\Responses\GetTradesHistoryResponse;
use Timirey\XApi\Responses\GetTradesResponse;
use Timirey\XApi\Responses\FetchTradesResponse;
use Timirey\XApi\Responses\FetchTradeStatusResponse;
use Timirey\XApi\Responses\GetTradingHoursResponse;
use Timirey\XApi\Responses\GetVersionResponse;
use Timirey\XApi\Responses\LoginResponse;
use Timirey\XApi\Responses\LogoutResponse;
use Timirey\XApi\Responses\PingResponse;
use Timirey\XApi\Responses\TradeTransactionResponse;
use Timirey\XApi\Responses\TradeTransactionStatusResponse;

/**
 * A client for interacting with the xStation5 API.
 */
class Client
{
    /**
     * @var SocketConnection $request Connection for sending requests.
     */
    protected SocketConnection $request;

    /**
     * @var SocketConnection $stream Connection for handling streaming data.
     */
    protected SocketConnection $stream;

    /**
     * @var string $streamSessionId Session ID for the streaming connection.
     */
    protected string $streamSessionId;

    /**
     * Client constructor.
     *
     * @param integer     $userId   User ID.
     * @param string      $password User password.
     * @param Host        $host     Host configuration.
     * @param string|null $appName  Optional application name.
     *
     * @throws SocketException If socket connection fails.
     * @throws InvalidResponseException If the response is invalid.
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     */
    public function __construct(
        protected int $userId,
        protected string $password,
        protected Host $host,
        protected ?string $appName = null
    ) {
        $this->connect();
    }

    /**
     * Logs in to the xStation5 API.
     *
     * @param integer     $userId   User ID.
     * @param string      $password User password.
     * @param string|null $appName  Application name.
     *
     * @return LoginResponse The response from the login request.
     *
     * @throws ErrorResponseException If the response indicates an error.
     * @throws InvalidResponseException Thrown when the API response is invalid or incomplete.
     * @throws JsonException If the response cannot be processed.
     * @throws SocketException If socket is empty or not initialized.
     */
    final public function login(int $userId, string $password, ?string $appName = null): LoginResponse
    {
        return $this->request(new LoginPayload($userId, $password, $appName), LoginResponse::class);
    }

    /**
     * Logs out from the xStation5 API.
     *
     * @return LogoutResponse The response from the logout request.
     *
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException If the response is invalid or incomplete.
     * @throws SocketException If socket is empty or not initialized.
     */
    final public function logout(): LogoutResponse
    {
        return $this->request(new LogoutPayload(), LogoutResponse::class);
    }

    /**
     * Retrieves information about a specific symbol.
     *
     * @param string $symbol The symbol to retrieve information for.
     * @return GetSymbolResponse The response containing symbol information.
     *
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException If the response is invalid or incomplete.
     * @throws SocketException If socket is empty or not initialized.
     */
    final public function getSymbol(string $symbol): GetSymbolResponse
    {
        return $this->request(new GetSymbolPayload($symbol), GetSymbolResponse::class);
    }

    /**
     * Retrieves information about all symbols.
     *
     * @return GetAllSymbolsResponse The response containing all symbols information.
     *
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException If the response is invalid or incomplete.
     * @throws SocketException If socket is empty or not initialized.
     */
    final public function getAllSymbols(): GetAllSymbolsResponse
    {
        return $this->request(new GetAllSymbolsPayload(), GetAllSymbolsResponse::class);
    }

    /**
     * Initiates a trade transaction.
     *
     * @param TradeTransInfo $tradeTransInfo Trade transaction details.
     * @return TradeTransactionResponse The response from the trade transaction request.
     *
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException If the response is invalid or incomplete.
     * @throws SocketException If socket is empty or not initialized.
     */
    final public function tradeTransaction(TradeTransInfo $tradeTransInfo): TradeTransactionResponse
    {
        return $this->request(new TradeTransactionPayload($tradeTransInfo), TradeTransactionResponse::class);
    }

    /**
     * Gets the current status of a trade transaction.
     *
     * @param integer $order Order ID.
     * @return TradeTransactionStatusResponse The response containing trade transaction status.
     *
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException If the response is invalid or incomplete.
     * @throws SocketException If socket is empty or not initialized.
     */
    final public function tradeTransactionStatus(int $order): TradeTransactionStatusResponse
    {
        return $this->request(new TradeTransactionStatusPayload($order), TradeTransactionStatusResponse::class);
    }

    /**
     * Refreshes the internal state of all system components.
     *
     * @return PingResponse The response from the ping request.
     *
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException If the response is invalid or incomplete.
     * @throws SocketException If socket is empty or not initialized.
     */
    final public function ping(): PingResponse
    {
        return $this->request(new PingPayload(), PingResponse::class);
    }

    /**
     * Returns calendar with market events.
     *
     * @return GetCalendarResponse The response containing market events calendar.
     *
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException If the response is invalid or incomplete.
     * @throws SocketException If socket is empty or not initialized.
     */
    final public function getCalendar(): GetCalendarResponse
    {
        return $this->request(new GetCalendarPayload(), GetCalendarResponse::class);
    }

    /**
     * Returns chart info, from start date to the current time.
     *
     * @param ChartLastInfoRecord $chartLastInfoRecord Details of the chart request.
     * @return GetChartLastRequestResponse The response containing chart info.
     *
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException If the response is invalid or incomplete.
     * @throws SocketException If socket is empty or not initialized.
     */
    final public function getChartLastRequest(ChartLastInfoRecord $chartLastInfoRecord): GetChartLastRequestResponse
    {
        return $this->request(
            new GetChartLastRequestPayload($chartLastInfoRecord),
            GetChartLastRequestResponse::class
        );
    }

    /**
     * Returns chart info, from start date to the current time.
     *
     * @param ChartRangeInfoRecord $chartRangeInfoRecord Details of the chart range request.
     * @return GetChartRangeRequestResponse The response containing chart range info.
     *
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException If the response is invalid or incomplete.
     * @throws SocketException If socket is empty or not initialized.
     */
    final public function getChartRangeRequest(ChartRangeInfoRecord $chartRangeInfoRecord): GetChartRangeRequestResponse
    {
        return $this->request(
            new GetChartRangeRequestPayload($chartRangeInfoRecord),
            GetChartRangeRequestResponse::class
        );
    }

    /**
     * Calculates the commission and rate of exchange for a given symbol and volume.
     *
     * @param string $symbol The trading symbol.
     * @param float  $volume The trading volume.
     * @return GetCommissionDefResponse The response containing commission definition.
     *
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException If the response is invalid or incomplete.
     * @throws SocketException If socket is empty or not initialized.
     */
    final public function getCommissionDef(string $symbol, float $volume): GetCommissionDefResponse
    {
        return $this->request(new GetCommissionDefPayload($symbol, $volume), GetCommissionDefResponse::class);
    }

    /**
     * Returns information about account currency, and account leverage.
     *
     * @return GetCurrentUserDataResponse The response containing current user data.
     *
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException If the response is invalid or incomplete.
     * @throws SocketException If socket is empty or not initialized.
     */
    final public function getCurrentUserData(): GetCurrentUserDataResponse
    {
        return $this->request(new GetCurrentUserDataPayload(), GetCurrentUserDataResponse::class);
    }

    /**
     * Returns various account indicators.
     *
     * @return GetMarginLevelResponse The response containing margin level information.
     *
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException If the response is invalid or incomplete.
     * @throws SocketException If socket is empty or not initialized.
     */
    final public function getMarginLevel(): GetMarginLevelResponse
    {
        return $this->request(new GetMarginLevelPayload(), GetMarginLevelResponse::class);
    }

    /**
     * Retrieves the expected margin for a given instrument and volume.
     *
     * @param string $symbol The trading symbol.
     * @param float  $volume The trading volume.
     * @return GetMarginTradeResponse The response containing margin trade information.
     *
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException If the response is invalid or incomplete.
     * @throws SocketException If socket is empty or not initialized.
     */
    final public function getMarginTrade(string $symbol, float $volume): GetMarginTradeResponse
    {
        return $this->request(new GetMarginTradePayload($symbol, $volume), GetMarginTradeResponse::class);
    }

    /**
     * Retrieves news from the trading server sent within a specified period.
     *
     * @param DateTime $start Start time for news retrieval.
     * @param DateTime $end   End time for news retrieval.
     * @return GetNewsResponse The response containing the news.
     *
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException If the response is invalid or incomplete.
     * @throws SocketException If socket is empty or not initialized.
     */
    final public function getNews(DateTime $start, DateTime $end): GetNewsResponse
    {
        return $this->request(new GetNewsPayload($start, $end), GetNewsResponse::class);
    }

    /**
     * Retrieves IBs data from the given time range.
     *
     * @param DateTime $start Start time for IBs history retrieval.
     * @param DateTime $end   End time for IBs history retrieval.
     * @return GetIbsHistoryResponse The response containing IBs history.
     *
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException If the response is invalid or incomplete.
     * @throws SocketException If socket is empty or not initialized.
     */
    final public function getIbsHistory(DateTime $start, DateTime $end): GetIbsHistoryResponse
    {
        return $this->request(new GetIbsHistoryPayload($start, $end), GetIbsHistoryResponse::class);
    }

    /**
     * Calculates estimated profit for the given deal data.
     *
     * @param float  $closePrice Theoretical close price of the order.
     * @param Cmd    $cmd        Operation code.
     * @param float  $openPrice  Theoretical open price of the order.
     * @param string $symbol     Trading symbol.
     * @param float  $volume     Trading volume.
     * @return GetProfitCalculationResponse The response containing profit calculation.
     *
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException If the response is invalid or incomplete.
     * @throws SocketException If socket is empty or not initialized.
     */
    final public function getProfitCalculation(
        float $closePrice,
        Cmd $cmd,
        float $openPrice,
        string $symbol,
        float $volume
    ): GetProfitCalculationResponse {
        return $this->request(
            new GetProfitCalculationPayload($closePrice, $cmd, $openPrice, $symbol, $volume),
            GetProfitCalculationResponse::class
        );
    }

    /**
     * Returns current time on trading server.
     *
     * @return GetServerTimeResponse The response containing the server time.
     *
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException If the response is invalid or incomplete.
     * @throws SocketException If socket is empty or not initialized.
     */
    final public function getServerTime(): GetServerTimeResponse
    {
        return $this->request(new GetServerTimePayload(), GetServerTimeResponse::class);
    }

    /**
     * Returns a list of step rules for DMAs.
     *
     * @return GetStepRulesResponse The response containing step rules.
     *
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException If the response is invalid or incomplete.
     * @throws SocketException If socket is empty or not initialized.
     */
    final public function getStepRules(): GetStepRulesResponse
    {
        return $this->request(new GetStepRulesPayload(), GetStepRulesResponse::class);
    }

    /**
     * Retrieves an array of current quotations for given symbols.
     *
     * @param Level              $level     The price level.
     * @param array<int, string> $symbols   Array of symbol names.
     * @param DateTime           $timestamp The time from which the most recent tick should be looked for.
     * @return GetTickPricesResponse The response containing tick prices.
     *
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException If the response is invalid or incomplete.
     * @throws SocketException If socket is empty or not initialized.
     */
    final public function getTickPrices(Level $level, array $symbols, DateTime $timestamp): GetTickPricesResponse
    {
        return $this->request(
            new GetTickPricesPayload($level, $symbols, $timestamp),
            GetTickPricesResponse::class
        );
    }

    /**
     * Retrieves an array of trades listed in the orders argument.
     *
     * @param array<int, int> $orders Array of order IDs.
     * @return GetTradeRecordsResponse The response containing trade records.
     *
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException If the response is invalid or incomplete.
     * @throws SocketException If socket is empty or not initialized.
     */
    final public function getTradeRecords(array $orders): GetTradeRecordsResponse
    {
        return $this->request(new GetTradeRecordsPayload($orders), GetTradeRecordsResponse::class);
    }

    /**
     * Retrieves an array of user's trades.
     *
     * @param boolean $openedOnly If true, only opened trades will be returned.
     * @return GetTradesResponse The response containing trades.
     *
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException If the response is invalid or incomplete.
     * @throws SocketException If socket is empty or not initialized.
     */
    final public function getTrades(bool $openedOnly): GetTradesResponse
    {
        return $this->request(new GetTradesPayload($openedOnly), GetTradesResponse::class);
    }

    /**
     * Returns array of user's trades which were closed within specified period of time.
     *
     * @param DateTime $start Start time for trade history retrieval.
     * @param DateTime $end   End time for trade history retrieval.
     * @return GetTradesHistoryResponse The response containing trades history.
     *
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException If the response is invalid or incomplete.
     * @throws SocketException If socket is empty or not initialized.
     */
    final public function getTradesHistory(DateTime $start, DateTime $end): GetTradesHistoryResponse
    {
        return $this->request(new GetTradesHistoryPayload($start, $end), GetTradesHistoryResponse::class);
    }

    /**
     * Returns quotes and trading times.
     *
     * @param array<int, string> $symbols Array of symbol names (Strings).
     * @return GetTradingHoursResponse The response containing trading hours.
     *
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException If the response is invalid or incomplete.
     * @throws SocketException If socket is empty or not initialized.
     */
    final public function getTradingHours(array $symbols): GetTradingHoursResponse
    {
        return $this->request(new GetTradingHoursPayload($symbols), GetTradingHoursResponse::class);
    }

    /**
     * Returns the current API version.
     *
     * @return GetVersionResponse The response containing the API version.
     *
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException If the response is invalid or incomplete.
     * @throws SocketException If socket is empty or not initialized.
     */
    final public function getVersion(): GetVersionResponse
    {
        return $this->request(new GetVersionPayload(), GetVersionResponse::class);
    }

    /**
     * Subscribe to balance stream.
     *
     * @param callable $callback Callback function to handle the response.
     *
     * @return void
     *
     * @throws InvalidPayloadException If payload is not valid.
     * @throws JsonException If JSON processing fails.
     * @throws ErrorResponseException If the response indicates an error.
     * @throws InvalidResponseException If the response is invalid.
     * @throws SocketException If socket is empty or not initialized.
     */
    final public function fetchBalance(callable $callback): void
    {
        $this->subscribe(
            new FetchBalancePayload($this->streamSessionId),
            FetchBalanceResponse::class,
            $callback
        );
    }

    /**
     * Subscribe to candles stream.
     *
     * @param string   $symbol   Symbol for which to get the candles.
     * @param callable $callback Callback function to handle the response.
     *
     * @return void
     *
     * @throws InvalidPayloadException If payload is not valid.
     * @throws JsonException If JSON processing fails.
     * @throws ErrorResponseException If the response indicates an error.
     * @throws InvalidResponseException If the response is invalid.
     * @throws SocketException If socket is empty or not initialized.
     */
    final public function fetchCandles(string $symbol, callable $callback): void
    {
        $this->subscribe(
            new FetchCandlesPayload($this->streamSessionId, $symbol),
            FetchCandlesResponse::class,
            $callback
        );
    }

    /**
     * Subscribe to keep alive stream.
     *
     * @param callable $callback Callback function to handle the response.
     *
     * @return void
     *
     * @throws InvalidPayloadException If payload is not valid.
     * @throws JsonException If JSON processing fails.
     * @throws ErrorResponseException If the response indicates an error.
     * @throws InvalidResponseException If the response is invalid.
     * @throws SocketException If socket is empty or not initialized.
     */
    final public function fetchKeepAlive(callable $callback): void
    {
        $this->subscribe(
            new FetchKeepAlivePayload($this->streamSessionId),
            FetchKeepAliveResponse::class,
            $callback
        );
    }

    /**
     * Subscribe to news stream.
     *
     * @param callable $callback Callback function to handle the response.
     *
     * @return void
     *
     * @throws InvalidPayloadException If payload is not valid.
     * @throws JsonException If JSON processing fails.
     * @throws ErrorResponseException If the response indicates an error.
     * @throws InvalidResponseException If the response is invalid.
     * @throws SocketException If socket is empty or not initialized.
     */
    final public function fetchNews(callable $callback): void
    {
        $this->subscribe(
            new FetchNewsPayload($this->streamSessionId),
            FetchNewsResponse::class,
            $callback
        );
    }

    /**
     * Subscribe to profits stream.
     *
     * @param callable $callback Callback function to handle the response.
     *
     * @return void
     *
     * @throws InvalidPayloadException If payload is not valid.
     * @throws JsonException If JSON processing fails.
     * @throws ErrorResponseException If the response indicates an error.
     * @throws InvalidResponseException If the response is invalid.
     * @throws SocketException If socket is empty or not initialized.
     */
    final public function fetchProfits(callable $callback): void
    {
        $this->subscribe(
            new FetchProfitsPayload($this->streamSessionId),
            FetchProfitsResponse::class,
            $callback
        );
    }

    /**
     * Subscribe to tick prices stream.
     *
     * @param string       $symbol         Symbol for which to get the tick prices.
     * @param callable     $callback       Callback function to handle the response.
     * @param integer|null $minArrivalTime Minimal interval in milliseconds between updates (optional).
     * @param integer|null $maxLevel       Maximum level of the quote (optional).
     *
     * @return void
     *
     * @throws InvalidPayloadException If payload is not valid.
     * @throws JsonException If JSON processing fails.
     * @throws ErrorResponseException If the response indicates an error.
     * @throws InvalidResponseException If the response is invalid.
     * @throws SocketException If socket is empty or not initialized.
     */
    final public function fetchTickPrices(
        string $symbol,
        callable $callback,
        ?int $minArrivalTime = null,
        ?int $maxLevel = null
    ): void {
        $this->subscribe(
            new FetchTickPricesPayload($this->streamSessionId, $symbol, $minArrivalTime, $maxLevel),
            FetchTickPricesResponse::class,
            $callback
        );
    }

    /**
     * Subscribe to trades stream.
     *
     * @param callable $callback Callback function to handle the response.
     *
     * @return void
     *
     * @throws InvalidPayloadException If payload is not valid.
     * @throws JsonException If JSON processing fails.
     * @throws ErrorResponseException If the response indicates an error.
     * @throws InvalidResponseException If the response is invalid.
     * @throws SocketException If socket is empty or not initialized.
     */
    final public function fetchTrades(callable $callback): void
    {
        $this->subscribe(
            new FetchTradesPayload($this->streamSessionId),
            FetchTradesResponse::class,
            $callback
        );
    }

    /**
     * Subscribe to trade status stream.
     *
     * @param callable $callback Callback function to handle the response.
     *
     * @return void
     *
     * @throws InvalidPayloadException If payload is not valid.
     * @throws JsonException If JSON processing fails.
     * @throws ErrorResponseException If the response indicates an error.
     * @throws InvalidResponseException If the response is invalid.
     * @throws SocketException If socket is empty or not initialized.
     */
    final public function fetchTradeStatus(callable $callback): void
    {
        $this->subscribe(
            new FetchTradeStatusPayload($this->streamSessionId),
            FetchTradeStatusResponse::class,
            $callback
        );
    }

    /**
     * Send a ping command to the xStation5 API.
     *
     * @return void
     * @throws SocketException If socket is empty or not initialized.
     */
    final public function pingStream(): void
    {
        $this->stream->send(new PingStreamPayload($this->streamSessionId));
    }

    /**
     * Establishes connection to the xStation5 API.
     *
     * @return void
     *
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException If the response is invalid or incomplete.
     * @throws SocketException If socket is empty or not initialized.
     */
    protected function connect(): void
    {
        $this->request = new SocketConnection($this->host->getRequestHost());

        $loginResponse = $this->login($this->userId, $this->password, $this->appName);

        $this->streamSessionId = $loginResponse->streamSessionId;
    }

    /**
     * Sends a request to the xStation5 API and returns the response.
     *
     * @template T of AbstractResponse
     *
     * @param AbstractPayload        $payload       The payload to send.
     * @param class-string<T>|string $responseClass The response class to instantiate.
     *
     * @return T The response instance.
     *
     * @throws ErrorResponseException If the response indicates an error.
     * @throws InvalidResponseException If the API response is invalid or incomplete.
     * @throws JsonException If the response cannot be processed.
     * @throws SocketException If socket is empty or not initialized.
     *
     * @phpstan-param class-string<T> $responseClass
     */
    protected function request(AbstractPayload $payload, string $responseClass): AbstractResponse
    {
        $this->ensureRequestConnection();

        $this->request->send($payload);

        return $responseClass::instantiate($this->request->receive());
    }

    /**
     * Sends a subscription request to the xStation5 API and processes the response.
     *
     * @template T of AbstractStreamResponse
     *
     * @param AbstractStreamPayload  $payload       The payload to send.
     * @param class-string<T>|string $responseClass The response class to instantiate.
     * @param callable               $callback      Callback function to handle the response.
     *
     * @return void
     *
     * @throws InvalidResponseException If the response is invalid.
     * @throws InvalidPayloadException If payload is not valid.
     * @throws JsonException If JSON processing fails.
     * @throws ErrorResponseException If the response indicates an error.
     * @throws SocketException If socket is empty or not initialized.
     *
     * @phpstan-param class-string<T> $responseClass
     */
    protected function subscribe(AbstractStreamPayload $payload, string $responseClass, callable $callback): void
    {
        $this->ensureStreamConnection();

        $this->stream->send($payload->toJson());

        foreach ($this->stream->listen() as $message) {
            $response = $responseClass::instantiate($message);

            $callback($response);
        }
    }

    /**
     * Ensures the request connection is established.
     *
     * @return void
     *
     * @throws ErrorResponseException If the response indicates an error.
     * @throws InvalidResponseException If the API response is invalid or incomplete.
     * @throws JsonException If the response cannot be processed.
     * @throws SocketException If socket is empty or not initialized.
     */
    protected function ensureRequestConnection(): void
    {
        if (!isset($this->request)) {
            $this->connect();
        }
    }

    /**
     * Ensures the stream connection is established.
     *
     * @return void
     *
     * @throws ErrorResponseException If the response indicates an error.
     * @throws InvalidResponseException If the API response is invalid or incomplete.
     * @throws JsonException If the response cannot be processed.
     * @throws SocketException If socket is empty or not initialized.
     */
    protected function ensureStreamConnection(): void
    {
        $this->ensureRequestConnection();

        if (!isset($this->stream)) {
            $this->stream = new SocketConnection($this->host->getStreamHost());
        }
    }
}
