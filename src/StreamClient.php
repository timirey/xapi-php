<?php

namespace Timirey\XApi;

use JsonException;
use Timirey\XApi\Connections\SocketConnection;
use Timirey\XApi\Enums\StreamHost;
use Timirey\XApi\Exceptions\ErrorResponseException;
use Timirey\XApi\Exceptions\InvalidPayloadException;
use Timirey\XApi\Exceptions\InvalidResponseException;
use Timirey\XApi\Exceptions\SocketException;
use Timirey\XApi\Payloads\AbstractStreamPayload;
use Timirey\XApi\Payloads\GetBalanceStreamPayload;
use Timirey\XApi\Payloads\GetCandlesStreamPayload;
use Timirey\XApi\Payloads\GetKeepAliveStreamPayload;
use Timirey\XApi\Payloads\GetNewsStreamPayload;
use Timirey\XApi\Payloads\GetProfitsStreamPayload;
use Timirey\XApi\Payloads\GetTickPricesStreamPayload;
use Timirey\XApi\Payloads\GetTradesStreamPayload;
use Timirey\XApi\Payloads\GetTradeStatusStreamPayload;
use Timirey\XApi\Payloads\PingStreamPayload;
use Timirey\XApi\Responses\AbstractStreamResponse;
use Timirey\XApi\Responses\GetBalanceStreamResponse;
use Timirey\XApi\Responses\GetCandlesStreamResponse;
use Timirey\XApi\Responses\GetKeepAliveStreamResponse;
use Timirey\XApi\Responses\GetNewsStreamResponse;
use Timirey\XApi\Responses\GetProfitsStreamResponse;
use Timirey\XApi\Responses\GetTickPricesStreamResponse;
use Timirey\XApi\Responses\GetTradesStreamResponse;
use Timirey\XApi\Responses\GetTradeStatusStreamResponse;

/**
 * Client class for handling streaming data from the xStation5 API.
 */
class StreamClient
{
    /**
     * @var SocketConnection Stream connection instance.
     */
    protected SocketConnection $socket;

    /**
     * Constructor for the StreamClient class.
     *
     * @param string     $streamSessionId Stream session ID.
     * @param StreamHost $host            Host URL.
     *
     * @throws SocketException If socket is unable to init.
     */
    public function __construct(protected string $streamSessionId, protected StreamHost $host)
    {
        $this->init();
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
    final public function getBalance(callable $callback): void
    {
        $this->subscribe(
            new GetBalanceStreamPayload($this->streamSessionId),
            GetBalanceStreamResponse::class,
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
    final public function getCandles(string $symbol, callable $callback): void
    {
        $this->subscribe(
            new GetCandlesStreamPayload($this->streamSessionId, $symbol),
            GetCandlesStreamResponse::class,
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
    final public function getKeepAlive(callable $callback): void
    {
        $this->subscribe(
            new GetKeepAliveStreamPayload($this->streamSessionId),
            GetKeepAliveStreamResponse::class,
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
    final public function getNews(callable $callback): void
    {
        $this->subscribe(
            new GetNewsStreamPayload($this->streamSessionId),
            GetNewsStreamResponse::class,
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
    final public function getProfits(callable $callback): void
    {
        $this->subscribe(
            new GetProfitsStreamPayload($this->streamSessionId),
            GetProfitsStreamResponse::class,
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
    final public function getTickPrices(
        string $symbol,
        callable $callback,
        ?int $minArrivalTime = null,
        ?int $maxLevel = null,
    ): void {
        $this->subscribe(
            new GetTickPricesStreamPayload($this->streamSessionId, $symbol, $minArrivalTime, $maxLevel),
            GetTickPricesStreamResponse::class,
            $callback
        );
    }

    /**
     * Subscribe to trades stream.
     *
     * @param callable $callback Callback function to handle the response.
     *
     * @return void;
     *
     * @throws InvalidPayloadException If payload is not valid.
     * @throws JsonException If JSON processing fails.
     * @throws ErrorResponseException If the response indicates an error.
     * @throws InvalidResponseException If the response is invalid.
     * @throws SocketException If socket is empty or not initialized.
     */
    final public function getTrades(callable $callback): void
    {
        $this->subscribe(
            new GetTradesStreamPayload($this->streamSessionId),
            GetTradesStreamResponse::class,
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
    final public function getTradeStatus(callable $callback): void
    {
        $this->subscribe(
            new GetTradeStatusStreamPayload($this->streamSessionId),
            GetTradeStatusStreamResponse::class,
            $callback
        );
    }

    /**
     * Send a ping command to the xStation5 API.
     *
     * @return void
     * @throws SocketException If socket is empty or not initialized.
     */
    final public function ping(): void
    {
        $this->socket->send(new PingStreamPayload($this->streamSessionId));
    }

    /**
     * Sends a request to the xStation5 API and processes the response.
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
        $this->socket->send($payload->toJson());

        foreach ($this->socket->listen() as $message) {
            $response = $responseClass::instantiate($message);

            call_user_func($callback, $response);
        }
    }

    /**
     * Creates new stream socket.
     *
     * @return void
     * @throws SocketException If socket is empty or not initialized.
     */
    protected function init(): void
    {
        $this->socket = new SocketConnection($this->host->value);
    }
}
