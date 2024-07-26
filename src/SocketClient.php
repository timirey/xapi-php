<?php

namespace Timirey\XApi;

use DateTime;
use Exception;
use JsonException;
use Timirey\XApi\Connections\Socket;
use Timirey\XApi\Enums\Cmd;
use Timirey\XApi\Enums\Host;
use Timirey\XApi\Enums\Level;
use Timirey\XApi\Exceptions\ErrorResponseException;
use Timirey\XApi\Exceptions\InvalidResponseException;
use Timirey\XApi\Exceptions\SocketException;
use Timirey\XApi\Payloads\AbstractPayload;
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
use Timirey\XApi\Payloads\GetStepRulesPayload;
use Timirey\XApi\Payloads\GetSymbolPayload;
use Timirey\XApi\Payloads\GetTickPricesPayload;
use Timirey\XApi\Payloads\GetTradeRecordsPayload;
use Timirey\XApi\Payloads\GetTradesHistoryPayload;
use Timirey\XApi\Payloads\GetTradesPayload;
use Timirey\XApi\Payloads\GetTradingHoursPayload;
use Timirey\XApi\Payloads\GetVersionPayload;
use Timirey\XApi\Payloads\LoginPayload;
use Timirey\XApi\Payloads\LogoutPayload;
use Timirey\XApi\Payloads\PingPayload;
use Timirey\XApi\Payloads\TradeTransactionPayload;
use Timirey\XApi\Payloads\TradeTransactionStatusPayload;
use Timirey\XApi\Responses\AbstractResponse;
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
use Timirey\XApi\Responses\GetStepRulesResponse;
use Timirey\XApi\Responses\GetSymbolResponse;
use Timirey\XApi\Responses\GetTickPricesResponse;
use Timirey\XApi\Responses\GetTradeRecordsResponse;
use Timirey\XApi\Responses\GetTradesHistoryResponse;
use Timirey\XApi\Responses\GetTradesResponse;
use Timirey\XApi\Responses\GetTradingHoursResponse;
use Timirey\XApi\Responses\GetVersionResponse;
use Timirey\XApi\Responses\LoginResponse;
use Timirey\XApi\Responses\LogoutResponse;
use Timirey\XApi\Responses\PingResponse;
use Timirey\XApi\Responses\TradeTransactionResponse;
use Timirey\XApi\Responses\TradeTransactionStatusResponse;

/**
 * Client class for interacting with the xStation5 API.
 */
class SocketClient
{
    /**
     * @var Socket Socket client instance.
     */
    protected Socket $socket;

    /**
     * Constructor for the Client class.
     *
     * @param Host $host Host URL.
     *
     * @throws SocketException If socket is unable to init.
     */
    public function __construct(protected Host $host)
    {
        $this->socket = new Socket($this->host->value);
    }

    /**
     * Logs in to the xStation5 API.
     *
     * @param integer $userId   User ID.
     * @param string  $password User password.
     *
     * @return LoginResponse The response from the login request.
     *
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException Thrown when the API response is invalid or incomplete.
     */
    public function login(int $userId, string $password): LoginResponse
    {
        return $this->request(new LoginPayload($userId, $password), LoginResponse::class);
    }

    /**
     * Logs out from the xStation5 API.
     *
     * @return LogoutResponse The response from the logout request.
     *
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException Thrown when the API response is invalid or incomplete.
     */
    public function logout(): LogoutResponse
    {
        return $this->request(new LogoutPayload(), LogoutResponse::class);
    }

    /**
     * Retrieves information about a specific symbol.
     *
     * @param  string $symbol The symbol to retrieve information for.
     * @return GetSymbolResponse The response containing symbol information.
     *
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException Thrown when the API response is invalid or incomplete.
     */
    public function getSymbol(string $symbol): GetSymbolResponse
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
     * @throws InvalidResponseException Thrown when the API response is invalid or incomplete.
     */
    public function getAllSymbols(): GetAllSymbolsResponse
    {
        return $this->request(new GetAllSymbolsPayload(), GetAllSymbolsResponse::class);
    }

    /**
     * Initiates a trade transaction.
     *
     * @param  TradeTransInfo $tradeTransInfo Trade transaction details.
     * @return TradeTransactionResponse The response from the trade transaction request.
     *
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException Thrown when the API response is invalid or incomplete.
     */
    public function tradeTransaction(TradeTransInfo $tradeTransInfo): TradeTransactionResponse
    {
        return $this->request(new TradeTransactionPayload($tradeTransInfo), TradeTransactionResponse::class);
    }

    /**
     * Gets the current status of a trade transaction.
     *
     * @param  integer $order Order ID.
     * @return TradeTransactionStatusResponse The response containing trade transaction status.
     *
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException Thrown when the API response is invalid or incomplete.
     */
    public function tradeTransactionStatus(int $order): TradeTransactionStatusResponse
    {
        return $this->request(
            new TradeTransactionStatusPayload($order),
            TradeTransactionStatusResponse::class
        );
    }

    /**
     * Refreshes the internal state of all system components.
     *
     * @return PingResponse The response from the ping request.
     *
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException Thrown when the API response is invalid or incomplete.
     */
    public function ping(): PingResponse
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
     * @throws InvalidResponseException Thrown when the API response is invalid or incomplete.
     */
    public function getCalendar(): GetCalendarResponse
    {
        return $this->request(new GetCalendarPayload(), GetCalendarResponse::class);
    }

    /**
     * Returns chart info, from start date to the current time.
     *
     * @param  ChartLastInfoRecord $chartLastInfoRecord Details of the chart request.
     * @return GetChartLastRequestResponse The response containing chart info.
     *
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException Thrown when the API response is invalid or incomplete.
     */
    public function getChartLastRequest(ChartLastInfoRecord $chartLastInfoRecord): GetChartLastRequestResponse
    {
        return $this->request(
            new GetChartLastRequestPayload($chartLastInfoRecord),
            GetChartLastRequestResponse::class
        );
    }

    /**
     * Returns chart info, from start date to the current time.
     *
     * @param  ChartRangeInfoRecord $chartRangeInfoRecord Details of the chart range request.
     * @return GetChartRangeRequestResponse The response containing chart range info.
     *
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException Thrown when the API response is invalid or incomplete.
     */
    public function getChartRangeRequest(ChartRangeInfoRecord $chartRangeInfoRecord): GetChartRangeRequestResponse
    {
        return $this->request(
            new GetChartRangeRequestPayload($chartRangeInfoRecord),
            GetChartRangeRequestResponse::class
        );
    }

    /**
     * Calculates the commission and rate of exchange for a given symbol and volume.
     *
     * @param  string $symbol The trading symbol.
     * @param  float  $volume The trading volume.
     * @return GetCommissionDefResponse The response containing commission definition.
     *
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException Thrown when the API response is invalid or incomplete.
     */
    public function getCommissionDef(string $symbol, float $volume): GetCommissionDefResponse
    {
        return $this->request(
            new GetCommissionDefPayload($symbol, $volume),
            GetCommissionDefResponse::class
        );
    }

    /**
     * Returns information about account currency, and account leverage.
     *
     * @return GetCurrentUserDataResponse The response containing current user data.
     *
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException Thrown when the API response is invalid or incomplete.
     */
    public function getCurrentUserData(): GetCurrentUserDataResponse
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
     * @throws InvalidResponseException Thrown when the API response is invalid or incomplete.
     */
    public function getMarginLevel(): GetMarginLevelResponse
    {
        return $this->request(new GetMarginLevelPayload(), GetMarginLevelResponse::class);
    }

    /**
     * Retrieves the expected margin for a given instrument and volume.
     *
     * @param  string $symbol The trading symbol.
     * @param  float  $volume The trading volume.
     * @return GetMarginTradeResponse The response containing margin trade information.
     *
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException Thrown when the API response is invalid or incomplete.
     */
    public function getMarginTrade(string $symbol, float $volume): GetMarginTradeResponse
    {
        return $this->request(
            new GetMarginTradePayload($symbol, $volume),
            GetMarginTradeResponse::class
        );
    }

    /**
     * Retrieves news from the trading server sent within a specified period.
     *
     * @param  DateTime $start Start time for news retrieval.
     * @param  DateTime $end   End time for news retrieval.
     * @return GetNewsResponse The response containing the news.
     *
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException Thrown when the API response is invalid or incomplete.
     */
    public function getNews(DateTime $start, DateTime $end): GetNewsResponse
    {
        return $this->request(new GetNewsPayload($start, $end), GetNewsResponse::class);
    }

    /**
     * Retrieves IBs data from the given time range.
     *
     * @param  DateTime $start Start time for IBs history retrieval.
     * @param  DateTime $end   End time for IBs history retrieval.
     * @return GetIbsHistoryResponse The response containing IBs history.
     *
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException Thrown when the API response is invalid or incomplete.
     */
    public function getIbsHistory(DateTime $start, DateTime $end): GetIbsHistoryResponse
    {
        return $this->request(new GetIbsHistoryPayload($start, $end), GetIbsHistoryResponse::class);
    }

    /**
     * Calculates estimated profit for the given deal data.
     *
     * @param  float  $closePrice Theoretical close price of the order.
     * @param  Cmd    $cmd        Operation code.
     * @param  float  $openPrice  Theoretical open price of the order.
     * @param  string $symbol     Trading symbol.
     * @param  float  $volume     Trading volume.
     * @return GetProfitCalculationResponse The response containing profit calculation.
     *
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException Thrown when the API response is invalid or incomplete.
     */
    public function getProfitCalculation(
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
     * @throws InvalidResponseException Thrown when the API response is invalid or incomplete.
     */
    public function getServerTime(): GetServerTimeResponse
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
     * @throws InvalidResponseException Thrown when the API response is invalid or incomplete.
     */
    public function getStepRules(): GetStepRulesResponse
    {
        return $this->request(new GetStepRulesPayload(), GetStepRulesResponse::class);
    }

    /**
     * Retrieves an array of current quotations for given symbols.
     *
     * @param  Level              $level     The price level.
     * @param  array<int, string> $symbols   Array of symbol names.
     * @param  DateTime           $timestamp The time from which the most recent tick should be looked for.
     * @return GetTickPricesResponse The response containing tick prices.
     *
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException Thrown when the API response is invalid or incomplete.
     */
    public function getTickPrices(Level $level, array $symbols, DateTime $timestamp): GetTickPricesResponse
    {
        return $this->request(
            new GetTickPricesPayload($level, $symbols, $timestamp),
            GetTickPricesResponse::class
        );
    }

    /**
     * Retrieves an array of trades listed in the orders argument.
     *
     * @param  array<int, int> $orders Array of order IDs.
     * @return GetTradeRecordsResponse The response containing trade records.
     *
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException Thrown when the API response is invalid or incomplete.
     */
    public function getTradeRecords(array $orders): GetTradeRecordsResponse
    {
        return $this->request(new GetTradeRecordsPayload($orders), GetTradeRecordsResponse::class);
    }

    /**
     * Retrieves an array of user's trades.
     *
     * @param  boolean $openedOnly If true, only opened trades will be returned.
     * @return GetTradesResponse The response containing trades.
     *
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException Thrown when the API response is invalid or incomplete.
     */
    public function getTrades(bool $openedOnly): GetTradesResponse
    {
        return $this->request(new GetTradesPayload($openedOnly), GetTradesResponse::class);
    }

    /**
     * Returns array of user's trades which were closed within specified period of time.
     *
     * @param  DateTime $start Start time for trade history retrieval.
     * @param  DateTime $end   End time for trade history retrieval.
     * @return GetTradesHistoryResponse The response containing trades history.
     *
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException Thrown when the API response is invalid or incomplete.
     */
    public function getTradesHistory(DateTime $start, DateTime $end): GetTradesHistoryResponse
    {
        return $this->request(new GetTradesHistoryPayload($start, $end), GetTradesHistoryResponse::class);
    }

    /**
     * Returns quotes and trading times.
     *
     * @param  array<int, string> $symbols Array of symbol names (Strings).
     * @return GetTradingHoursResponse The response containing trading hours.
     *
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException Thrown when the API response is invalid or incomplete.
     */
    public function getTradingHours(array $symbols): GetTradingHoursResponse
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
     * @throws InvalidResponseException Thrown when the API response is invalid or incomplete.
     */
    public function getVersion(): GetVersionResponse
    {
        return $this->request(new GetVersionPayload(), GetVersionResponse::class);
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
     * @throws InvalidResponseException Thrown when the API response is invalid or incomplete.
     * @throws JsonException If the response cannot be processed.
     *
     * @phpstan-param class-string<T> $responseClass
     */
    protected function request(AbstractPayload $payload, string $responseClass): AbstractResponse
    {
        $this->socket->send($payload);

        return $responseClass::instantiate($this->socket->receive());
    }
}