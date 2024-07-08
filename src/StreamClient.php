<?php

namespace Timirey\XApi;

use Timirey\XApi\Enums\StreamHost;
use WebSocket\Client as WebSocketClient;

class StreamClient
{
    /**
     * XTB WebSocket stream client instance.
     */
    protected WebSocketClient $streamClient;

    /**
     * Constructor for the StreamClient class.
     *
     * @param StreamHost $host WebSocket host URL.
     */
    public function __construct(protected StreamHost $host, protected string $streamSessionId)
    {
        $this->streamClient = new WebSocketClient($this->host->value);
    }
}
