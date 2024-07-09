<?php

namespace Timirey\XApi;

use JsonException;
use Timirey\XApi\Enums\StreamHost;
use Timirey\XApi\Exceptions\InvalidResponseException;
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
use WebSocket\Client as WebSocketClient;

/**
 * Client class for handling streaming data from the xStation5 API.
 */
class StreamClient
{
    /**
     * @var WebsocketClient XTB WebSocket stream client instance.
     */
    protected WebSocketClient $streamClient;

    /**
     * @var boolean Flag to control the streaming loop.
     */
    protected bool $streaming = false;

    /**
     * Constructor for the StreamClient class.
     *
     * @param  string     $streamSessionId Stream session ID.
     * @param  StreamHost $host            WebSocket host URL.
     */
    public function __construct(protected string $streamSessionId, protected StreamHost $host)
    {
        $this->streamClient = new WebSocketClient($this->host->value);
    }

    /**
     * Subscribe to balance stream.
     *
     * @param  callable $callback Callback function to handle the response.
     *
     * @throws InvalidResponseException If the response is invalid.
     * @throws JsonException If JSON processing fails.
     *
     * @return void
     */
    public function getBalance(callable $callback): void
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
     * @param  string   $symbol   Symbol for which to get the candles.
     * @param  callable $callback Callback function to handle the response.
     *
     * @throws InvalidResponseException If the response is invalid.
     * @throws JsonException If JSON processing fails.
     *
     * @return void
     */
    public function getCandles(string $symbol, callable $callback): void
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
     * @param  callable $callback Callback function to handle the response.
     *
     * @throws InvalidResponseException If the response is invalid.
     * @throws JsonException If JSON processing fails.
     *
     * @return void
     */
    public function getKeepAlive(callable $callback): void
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
     * @param  callable $callback Callback function to handle the response.
     *
     * @throws InvalidResponseException If the response is invalid.
     * @throws JsonException If JSON processing fails.
     *
     * @return void
     */
    public function getNews(callable $callback): void
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
     * @param  callable $callback Callback function to handle the response.
     *
     * @throws InvalidResponseException If the response is invalid.
     * @throws JsonException If JSON processing fails.
     *
     * @return void
     */
    public function getProfits(callable $callback): void
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
     * @param  string       $symbol         Symbol for which to get the tick prices.
     * @param  callable     $callback       Callback function to handle the response.
     * @param  integer|null $minArrivalTime Minimal interval in milliseconds between updates (optional).
     * @param  integer|null $maxLevel       Maximum level of the quote (optional).
     *
     * @throws InvalidResponseException If the response is invalid.
     * @throws JsonException If JSON processing fails.
     *
     * @return void
     */
    public function getTickPrices(
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
     * @param  callable $callback Callback function to handle the response.
     *
     * @throws InvalidResponseException If the response is invalid.
     * @throws JsonException If JSON processing fails.
     *
     * @return void
     */
    public function getTrades(callable $callback): void
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
     * @param  callable $callback Callback function to handle the response.
     *
     * @throws InvalidResponseException If the response is invalid.
     * @throws JsonException If JSON processing fails.
     *
     * @return void
     */
    public function getTradeStatus(callable $callback): void
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
     */
    public function ping(): void
    {
        $this->streamClient->text(new PingStreamPayload($this->streamSessionId));
    }

    /**
     * Sends a request to the xStation5 API and processes the response.
     *
     * @template T of AbstractStreamResponse
     *
     * @param  AbstractStreamPayload  $payload       The payload to send.
     * @param  class-string<T>|string $responseClass The response class to instantiate.
     * @param  callable               $callback      Callback function to handle the response.
     *
     * @throws InvalidResponseException If the response is invalid.
     * @throws JsonException If JSON processing fails.
     *
     * @return void
     */
    protected function subscribe(AbstractStreamPayload $payload, string $responseClass, callable $callback): void
    {
        $this->streaming = true;

        $this->streamClient->text($payload);

        // todo: think of different approach instead of infinite cycle, maybe use promises?
        while ($this->streaming) {
            $response = $responseClass::instantiate($this->streamClient->receive()->getContent());

            // todo: we should perform a check for duplicated response, maybe by timestamp?
            call_user_func($callback, $response);
        }
    }

    /**
     * Unsubscribe from the stream.
     *
     * @return void
     */
    public function unsubscribe(): void
    {
        $this->streaming = false;
    }
}
