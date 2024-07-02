<?php

namespace Timirey\XApi;

use DateTime;
use JsonException;
use Timirey\XApi\Enums\Cmd;
use Timirey\XApi\Enums\Host;
use Timirey\XApi\Enums\Level;
use Timirey\XApi\Exceptions\ErrorResponseException;
use Timirey\XApi\Exceptions\InvalidResponseException;
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
use WebSocket\Client as WebSocketClient;

/**
 * Client class for interacting with the xStation5 API.
 */
class Client
{
    /**
     * XTB WebSocket client instance.
     *
     * @var WebSocketClient
     */
    protected WebSocketClient $client;

    /**
     * Constructor for the Client class.
     *
     * @param integer $userId   User ID.
     * @param string  $password User password.
     * @param Host    $host     WebSocket host URL.
     */
    public function __construct(protected int $userId, protected string $password, protected Host $host)
    {
        $this->client = new WebSocketClient($this->host->value);
    }

    /**
     * Logs in to the xStation5 API.
     *
     * @return LoginResponse
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException Thrown when the API response is invalid or incomplete.
     */
    public function login(): LoginResponse
    {
        return $this->sendRequest(new LoginPayload($this->userId, $this->password), LoginResponse::class);
    }

    /**
     * Logs out from the xStation5 API.
     *
     * @return LogoutResponse
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException Thrown when the API response is invalid or incomplete.
     */
    public function logout(): LogoutResponse
    {
        return $this->sendRequest(new LogoutPayload(), LogoutResponse::class);
    }

    /**
     * Retrieves information about a specific symbol.
     *
     * @param string $symbol The symbol to retrieve information for.
     * @return GetSymbolResponse
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException Thrown when the API response is invalid or incomplete.
     */
    public function getSymbol(string $symbol): GetSymbolResponse
    {
        return $this->sendRequest(new GetSymbolPayload($symbol), GetSymbolResponse::class);
    }

    /**
     * Retrieves information about all symbols.
     *
     * @return GetAllSymbolsResponse
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException Thrown when the API response is invalid or incomplete.
     */
    public function getAllSymbols(): GetAllSymbolsResponse
    {
        return $this->sendRequest(new GetAllSymbolsPayload(), GetAllSymbolsResponse::class);
    }

    /**
     * Initiates a trade transaction.
     *
     * @param TradeTransInfo $tradeTransInfo Trade transaction details.
     * @return TradeTransactionResponse
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException Thrown when the API response is invalid or incomplete.
     */
    public function tradeTransaction(TradeTransInfo $tradeTransInfo): TradeTransactionResponse
    {
        return $this->sendRequest(new TradeTransactionPayload($tradeTransInfo), TradeTransactionResponse::class);
    }

    /**
     * Gets the current status of a trade transaction.
     *
     * @param integer $order Order ID.
     * @return TradeTransactionStatusResponse
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException Thrown when the API response is invalid or incomplete.
     */
    public function tradeTransactionStatus(int $order): TradeTransactionStatusResponse
    {
        return $this->sendRequest(
            new TradeTransactionStatusPayload($order),
            TradeTransactionStatusResponse::class
        );
    }

    /**
     * Refreshes the internal state of all system components.
     *
     * @return PingResponse
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException Thrown when the API response is invalid or incomplete.
     */
    public function ping(): PingResponse
    {
        return $this->sendRequest(new PingPayload(), PingResponse::class);
    }

    /**
     * Returns calendar with market events.
     *
     * @return GetCalendarResponse
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException Thrown when the API response is invalid or incomplete.
     */
    public function getCalendar(): GetCalendarResponse
    {
        return $this->sendRequest(new GetCalendarPayload(), GetCalendarResponse::class);
    }

    /**
     * Returns chart info, from start date to the current time.
     *
     * @param ChartLastInfoRecord $chartLastInfoRecord Details of the chart request.
     * @return GetChartLastRequestResponse
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException Thrown when the API response is invalid or incomplete.
     */
    public function getChartLastRequest(ChartLastInfoRecord $chartLastInfoRecord): GetChartLastRequestResponse
    {
        return $this->sendRequest(
            new GetChartLastRequestPayload($chartLastInfoRecord),
            GetChartLastRequestResponse::class
        );
    }

    /**
     * Returns chart info, from start date to the current time.
     *
     * @param ChartRangeInfoRecord $chartRangeInfoRecord Details of the chart range request.
     * @return GetChartRangeRequestResponse
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException Thrown when the API response is invalid or incomplete.
     */
    public function getChartRangeRequest(ChartRangeInfoRecord $chartRangeInfoRecord): GetChartRangeRequestResponse
    {
        return $this->sendRequest(
            new GetChartRangeRequestPayload($chartRangeInfoRecord),
            GetChartRangeRequestResponse::class
        );
    }

    /**
     * Calculates the commission and rate of exchange for a given symbol and volume.
     *
     * @param string $symbol The trading symbol.
     * @param float  $volume The trading volume.
     * @return GetCommissionDefResponse
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException Thrown when the API response is invalid or incomplete.
     */
    public function getCommissionDef(string $symbol, float $volume): GetCommissionDefResponse
    {
        return $this->sendRequest(
            new GetCommissionDefPayload($symbol, $volume),
            GetCommissionDefResponse::class
        );
    }

    /**
     * Returns information about account currency, and account leverage.
     *
     * @return GetCurrentUserDataResponse
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException Thrown when the API response is invalid or incomplete.
     */
    public function getCurrentUserData(): GetCurrentUserDataResponse
    {
        return $this->sendRequest(new GetCurrentUserDataPayload(), GetCurrentUserDataResponse::class);
    }

    /**
     * Returns various account indicators.
     *
     * @return GetMarginLevelResponse
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException Thrown when the API response is invalid or incomplete.
     */
    public function getMarginLevel(): GetMarginLevelResponse
    {
        return $this->sendRequest(new GetMarginLevelPayload(), GetMarginLevelResponse::class);
    }

    /**
     * Retrieves the expected margin for a given instrument and volume.
     *
     * @param string $symbol The trading symbol.
     * @param float  $volume The trading volume.
     * @return GetMarginTradeResponse
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException Thrown when the API response is invalid or incomplete.
     */
    public function getMarginTrade(string $symbol, float $volume): GetMarginTradeResponse
    {
        return $this->sendRequest(
            new GetMarginTradePayload($symbol, $volume),
            GetMarginTradeResponse::class
        );
    }

    /**
     * Retrieves news from the trading server sent within a specified period.
     *
     * @param DateTime $start Start time for news retrieval.
     * @param DateTime $end   End time for news retrieval.
     * @return GetNewsResponse Response containing the news.
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException Thrown when the API response is invalid or incomplete.
     */
    public function getNews(DateTime $start, DateTime $end): GetNewsResponse
    {
        return $this->sendRequest(new GetNewsPayload($start, $end), GetNewsResponse::class);
    }

    /**
     * Retrieves IBs data from the given time range.
     *
     * @param DateTime $start Start time for IBs history retrieval.
     * @param DateTime $end   End time for IBs history retrieval.
     * @return GetIbsHistoryResponse
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException Thrown when the API response is invalid or incomplete.
     */
    public function getIbsHistory(DateTime $start, DateTime $end): GetIbsHistoryResponse
    {
        return $this->sendRequest(new GetIbsHistoryPayload($start, $end), GetIbsHistoryResponse::class);
    }

    /**
     * Calculates estimated profit for the given deal data.
     *
     * @param float  $closePrice Theoretical close price of the order.
     * @param Cmd    $cmd        Operation code.
     * @param float  $openPrice  Theoretical open price of the order.
     * @param string $symbol     Trading symbol.
     * @param float  $volume     Trading volume.
     * @return GetProfitCalculationResponse
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
        return $this->sendRequest(
            new GetProfitCalculationPayload($closePrice, $cmd, $openPrice, $symbol, $volume),
            GetProfitCalculationResponse::class
        );
    }

    /**
     * Returns current time on trading server.
     *
     * @return GetServerTimeResponse
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException Thrown when the API response is invalid or incomplete.
     */
    public function getServerTime(): GetServerTimeResponse
    {
        return $this->sendRequest(new GetServerTimePayload(), GetServerTimeResponse::class);
    }

    /**
     * Returns a list of step rules for DMAs.
     *
     * @return GetStepRulesResponse
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException Thrown when the API response is invalid or incomplete.
     */
    public function getStepRules(): GetStepRulesResponse
    {
        return $this->sendRequest(new GetStepRulesPayload(), GetStepRulesResponse::class);
    }

    /**
     * Retrieves an array of current quotations for given symbols.
     *
     * @param Level    $level     The price level.
     * @param array    $symbols   Array of symbol names.
     * @param DateTime $timestamp The time from which the most recent tick should be looked for.
     * @return GetTickPricesResponse
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException Thrown when the API response is invalid or incomplete.
     */
    public function getTickPrices(Level $level, array $symbols, DateTime $timestamp): GetTickPricesResponse
    {
        return $this->sendRequest(
            new GetTickPricesPayload($level, $symbols, $timestamp),
            GetTickPricesResponse::class
        );
    }

    /**
     * Retrieves an array of trades listed in the orders argument.
     *
     * @param array $orders Array of order IDs.
     * @return GetTradeRecordsResponse
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException Thrown when the API response is invalid or incomplete.
     */
    public function getTradeRecords(array $orders): GetTradeRecordsResponse
    {
        return $this->sendRequest(new GetTradeRecordsPayload($orders), GetTradeRecordsResponse::class);
    }

    /**
     * Retrieves an array of user's trades.
     *
     * @param boolean $openedOnly If true, only opened trades will be returned.
     * @return GetTradesResponse
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException Thrown when the API response is invalid or incomplete.
     */
    public function getTrades(bool $openedOnly): GetTradesResponse
    {
        return $this->sendRequest(new GetTradesPayload($openedOnly), GetTradesResponse::class);
    }

    /**
     * Returns array of user's trades which were closed within specified period of time.
     *
     * @param DateTime $start Start time for trade history retrieval.
     * @param DateTime $end   End time for trade history retrieval.
     * @return GetTradesHistoryResponse
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException Thrown when the API response is invalid or incomplete.
     */
    public function getTradesHistory(DateTime $start, DateTime $end): GetTradesHistoryResponse
    {
        return $this->sendRequest(new GetTradesHistoryPayload($start, $end), GetTradesHistoryResponse::class);
    }

    /**
     * Returns quotes and trading times.
     *
     * @param array $symbols Array of symbol names (Strings).
     * @return GetTradingHoursResponse
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException Thrown when the API response is invalid or incomplete.
     */
    public function getTradingHours(array $symbols): GetTradingHoursResponse
    {
        return $this->sendRequest(new GetTradingHoursPayload($symbols), GetTradingHoursResponse::class);
    }

    /**
     * Returns the current API version.
     *
     * @return GetVersionResponse
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException Thrown when the API response is invalid or incomplete.
     */
    public function getVersion(): GetVersionResponse
    {
        return $this->sendRequest(new GetVersionPayload(), GetVersionResponse::class);
    }

    /**
     * Sends a request to the xStation5 API and returns the response.
     *
     * @template T of AbstractResponse
     * @param AbstractPayload        $payload       The payload to send.
     * @param class-string<T>|string $responseClass The response class to instantiate.
     * @return AbstractResponse|T The response instance.
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException Thrown when the API response is invalid or incomplete.
     */
    protected function sendRequest(AbstractPayload $payload, string $responseClass): AbstractResponse
    {
        $this->client->text($payload);

        return $responseClass::instantiate($this->client->receive()->getContent());
    }
}
