<?php

namespace Timirey\XApi;

use JsonException;
use Timirey\XApi\Connections\SocketConnection;
use Timirey\XApi\Enums\Host;
use Timirey\XApi\Exceptions\ErrorResponseException;
use Timirey\XApi\Exceptions\InvalidPayloadException;
use Timirey\XApi\Exceptions\InvalidResponseException;
use Timirey\XApi\Exceptions\SocketException;
use Timirey\XApi\Payloads\AbstractStreamPayload;
use Timirey\XApi\Payloads\FetchBalancePayload;
use Timirey\XApi\Payloads\FetchCandlesPayload;
use Timirey\XApi\Payloads\FetchKeepAlivePayload;
use Timirey\XApi\Payloads\FetchNewsPayload;
use Timirey\XApi\Payloads\FetchProfitsPayload;
use Timirey\XApi\Payloads\FetchTickPricesPayload;
use Timirey\XApi\Payloads\FetchTradesPayload;
use Timirey\XApi\Payloads\FetchTradeStatusPayload;
use Timirey\XApi\Payloads\PingStreamPayload;
use Timirey\XApi\Responses\AbstractStreamResponse;
use Timirey\XApi\Responses\FetchBalanceResponse;
use Timirey\XApi\Responses\FetchCandlesResponse;
use Timirey\XApi\Responses\FetchKeepAliveResponse;
use Timirey\XApi\Responses\FetchNewsResponse;
use Timirey\XApi\Responses\FetchProfitsResponse;
use Timirey\XApi\Responses\FetchTickPricesResponse;
use Timirey\XApi\Responses\FetchTradesResponse;
use Timirey\XApi\Responses\FetchTradeStatusResponse;

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
     * @param string $streamSessionId Stream session ID.
     * @param Host   $host            Host URL.
     *
     * @throws SocketException If socket is unable to init.
     */
    public function __construct(protected string $streamSessionId, protected Host $host)
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
        ?int $maxLevel = null,
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
     * @return void;
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
        $this->stream->send($payload->toJson());

        foreach ($this->stream->listen() as $message) {
            $response = $responseClass::instantiate($message);

            $callback($response);
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
        $this->stream = new SocketConnection($this->host->getStreamHost());
    }
}
