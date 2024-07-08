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
use Timirey\XApi\Responses\AbstractStreamResponse;
use Timirey\XApi\Responses\GetBalanceStreamResponse;
use Timirey\XApi\Responses\GetCandlesStreamResponse;
use Timirey\XApi\Responses\GetKeepAliveStreamResponse;
use Timirey\XApi\Responses\GetNewsStreamResponse;
use WebSocket\Client as WebSocketClient;

/**
 * Client class for handling streaming data from the xStation5 API.
 */
class StreamClient
{
    /**
     * XTB WebSocket stream client instance.
     */
    protected WebSocketClient $streamClient;

    /**
     * Flag to control the streaming loop.
     */
    protected bool $streaming = false;

    /**
     * Constructor for the StreamClient class.
     *
     * @param string     $streamSessionId Stream session ID.
     * @param StreamHost $host            WebSocket host URL.
     */
    public function __construct(protected string $streamSessionId, protected StreamHost $host)
    {
        $this->streamClient = new WebSocketClient($this->host->value);
    }

    /**
     * Subscribe to balance stream.
     *
     * @param callable $callback Callback function to handle the response.
     *
     * @throws InvalidResponseException If the response is invalid.
     * @throws JsonException            If JSON processing fails.
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
     * @param string   $symbol   Symbol for which to get the candles.
     * @param callable $callback Callback function to handle the response.
     *
     * @throws InvalidResponseException If the response is invalid.
     * @throws JsonException            If JSON processing fails.
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
     * @param callable $callback Callback function to handle the response.
     *
     * @throws InvalidResponseException If the response is invalid.
     * @throws JsonException            If JSON processing fails.
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
     * @param callable $callback Callback function to handle the response.
     *
     * @throws InvalidResponseException If the response is invalid.
     * @throws JsonException            If JSON processing fails.
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
     * Sends a request to the xStation5 API and processes the response.
     *
     * @template T of AbstractStreamResponse
     *
     * @param AbstractStreamPayload  $payload       The payload to send.
     * @param class-string<T>|string $responseClass The response class to instantiate.
     * @param callable               $callback      Callback function to handle the response.
     *
     * @throws InvalidResponseException If the response is invalid.
     * @throws JsonException            If JSON processing fails.
     */
    protected function subscribe(AbstractStreamPayload $payload, string $responseClass, callable $callback): void
    {
        $this->streaming = true;

        $this->streamClient->text($payload);

        while ($this->streaming) {
            $response = $responseClass::instantiate($this->streamClient->receive()->getContent());

            call_user_func($callback, $response);
        }
    }

    /**
     * Unsubscribe from the stream.
     */
    public function unsubscribe(): void
    {
        $this->streaming = false;
    }
}
