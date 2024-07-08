<?php

namespace Timirey\XApi;

use JsonException;
use Timirey\XApi\Enums\StreamHost;
use Timirey\XApi\Exceptions\InvalidResponseException;
use Timirey\XApi\Payloads\AbstractStreamPayload;
use Timirey\XApi\Payloads\GetBalanceStreamPayload;
use Timirey\XApi\Responses\AbstractStreamResponse;
use Timirey\XApi\Responses\GetBalanceStreamResponse;
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
