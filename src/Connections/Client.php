<?php

namespace Timirey\XApi\Connections;

use Timirey\XApi\Connections\Enums\Host;
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
use Timirey\XApi\Payloads\GetSymbolPayload;
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
use Timirey\XApi\Responses\GetSymbolResponse;
use Timirey\XApi\Responses\LoginResponse;
use Timirey\XApi\Responses\LogoutResponse;
use Timirey\XApi\Responses\PingResponse;
use Timirey\XApi\Responses\TradeTransactionResponse;
use Timirey\XApi\Responses\TradeTransactionStatusResponse;
use WebSocket\Client as WebSocketClient;

/**
 * Client class for interacting with the xStation5 API.
 *
 * todo: rename this class and think of better folder structure.
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
     * @param int $userId User ID.
     * @param string $password User password.
     * @param Host $host WebSocket host URL.
     */
    public function __construct(
        protected int $userId,
        protected string $password,
        protected Host $host
    ) {
        $this->client = new WebSocketClient($this->host->value);
    }

    /**
     * Logs in to the xStation5 API.
     *
     * @return LoginResponse
     */
    public function login(): LoginResponse
    {
        return $this->sendRequest(new LoginPayload($this->userId, $this->password), LoginResponse::class);
    }

    /**
     * Logs out from the xStation5 API.
     *
     * @return LogoutResponse
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
     */
    public function getSymbol(string $symbol): GetSymbolResponse
    {
        return $this->sendRequest(new GetSymbolPayload($symbol), GetSymbolResponse::class);
    }

    /**
     * Retrieves information about all symbols.
     *
     * @return GetAllSymbolsResponse
     */
    public function getAllSymbols(): GetAllSymbolsResponse
    {
        return $this->sendRequest(new GetAllSymbolsPayload(), GetAllSymbolsResponse::class);
    }

    /**
     * Starts trade transaction.
     *
     * @param TradeTransInfo $tradeTransInfo
     * @return TradeTransactionResponse
     */
    public function tradeTransaction(TradeTransInfo $tradeTransInfo): TradeTransactionResponse
    {
        return $this->sendRequest(new TradeTransactionPayload($tradeTransInfo), TradeTransactionResponse::class);
    }

    /**
     * Returns current transaction status.
     *
     * @param int $order
     * @return TradeTransactionStatusResponse
     */
    public function tradeTransactionStatus(int $order): TradeTransactionStatusResponse
    {
        return $this->sendRequest(new TradeTransactionStatusPayload($order), TradeTransactionStatusResponse::class);
    }

    /**
     * Regularly calling this function is enough to refresh the internal state of all the components in the system.
     *
     * @return PingResponse
     */
    public function ping(): PingResponse
    {
        return $this->sendRequest(new PingPayload(), PingResponse::class);
    }

    /**
     * Returns calendar with market events.
     *
     * @return GetCalendarResponse
     */
    public function getCalendar(): GetCalendarResponse
    {
        return $this->sendRequest(new GetCalendarPayload(), GetCalendarResponse::class);
    }

    /**
     * Returns chart info, from start date to the current time.
     *
     * @param ChartLastInfoRecord $chartLastInfoRecord
     * @return GetChartLastRequestResponse
     */
    public function getChartLastRequest(ChartLastInfoRecord $chartLastInfoRecord): GetChartLastRequestResponse
    {
        return $this->sendRequest(new GetChartLastRequestPayload($chartLastInfoRecord), GetChartLastRequestResponse::class);
    }

    /**
     * Returns chart info, from start date to the current time.
     *
     * @param ChartRangeInfoRecord $chartRangeInfoRecord
     * @return GetChartRangeRequestResponse
     */
    public function getChartRangeRequest(ChartRangeInfoRecord $chartRangeInfoRecord): GetChartRangeRequestResponse
    {
        return $this->sendRequest(new GetChartRangeRequestPayload($chartRangeInfoRecord), GetChartRangeRequestResponse::class);
    }

    /**
     * Returns calculation of commission and rate of exchange.
     *
     * @param string $symbol
     * @param float $volume
     * @return GetCommissionDefResponse
     */
    public function getCommissionDef(string $symbol, float $volume): GetCommissionDefResponse
    {
        return $this->sendRequest(new GetCommissionDefPayload($symbol, $volume), GetCommissionDefResponse::class);
    }

    /**
     * Returns information about account currency, and account leverage.
     *
     * @return GetCurrentUserDataResponse
     */
    public function getCurrentUserData(): GetCurrentUserDataResponse
    {
        return $this->sendRequest(new GetCurrentUserDataPayload(), GetCurrentUserDataResponse::class);
    }

    /**
     * Returns various account indicators.
     *
     * @return GetMarginLevelResponse
     */
    public function getMarginLevel(): GetMarginLevelResponse
    {
        return $this->sendRequest(new GetMarginLevelPayload(), GetMarginLevelResponse::class);
    }

    /**
     * Returns expected margin for given instrument and volume.
     *
     * @param string $symbol
     * @param float $volume
     * @return GetMarginTradeResponse
     */
    public function getMarginTrade(string $symbol, float $volume): GetMarginTradeResponse
    {
        return $this->sendRequest(new GetMarginTradePayload($symbol, $volume), GetMarginTradeResponse::class);
    }

    /**
     * Returns news from the trading server which were sent within a specified period of time.
     *
     * @param int $start
     * @param int $end
     * @return GetNewsResponse
     */
    public function getNews(int $start, int $end): GetNewsResponse
    {
        return $this->sendRequest(new GetNewsPayload($start, $end), GetNewsResponse::class);
    }

    /**
     * Returns IBs data from the given time range.
     *
     * @param int $start
     * @param int $end
     * @return GetIbsHistoryResponse
     */
    public function getIbsHistory(int $start, int $end): GetIbsHistoryResponse
    {
        return $this->sendRequest(new GetIbsHistoryPayload($start, $end), GetIbsHistoryResponse::class);
    }

    /**
     * Calculates estimated profit for given deal data.
     *
     * @param float $closePrice
     * @param int $cmd
     * @param float $openPrice
     * @param string $symbol
     * @param float $volume
     * @return GetProfitCalculationResponse
     */
    public function getProfitCalculation(float $closePrice, int $cmd, float $openPrice, string $symbol, float $volume): GetProfitCalculationResponse
    {
        return $this->sendRequest(new GetProfitCalculationPayload($closePrice, $cmd, $openPrice, $symbol, $volume), GetProfitCalculationResponse::class);
    }


    /**
     * Sends a request to the xStation5 API and returns the response.
     *
     * @template T of AbstractResponse
     * @param AbstractPayload $payload The payload to send.
     * @param class-string<T> $responseClass The response class to instantiate.
     * @return AbstractResponse The response instance.
     * @return T
     */
    protected function sendRequest(AbstractPayload $payload, string $responseClass): AbstractResponse
    {
        $this->client->text($payload);

        return $responseClass::instantiate($this->client->receive()->getContent());
    }
}
