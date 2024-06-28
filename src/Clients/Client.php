<?php

namespace Timirey\XApi\Clients;

use Timirey\XApi\Clients\Enums\Host;
use Timirey\XApi\Payloads\AbstractPayload;
use Timirey\XApi\Payloads\Data\ChartLastInfoRecord;
use Timirey\XApi\Payloads\Data\TradeTransInfo;
use Timirey\XApi\Payloads\GetAllSymbolsPayload;
use Timirey\XApi\Payloads\GetCalendarPayload;
use Timirey\XApi\Payloads\GetChartLastRequestPayload;
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
