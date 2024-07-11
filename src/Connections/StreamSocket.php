<?php

namespace Timirey\XApi\Connections;

use Generator;

/**
 * Extends the Socket class to provide additional functionality for
 * listening to data from a stream socket connection.
 */
class StreamSocket extends Socket
{
    /**
     * Listen to the stream socket and yield data as it is received.
     *
     * @return Generator Yields data received from the socket.
     */
    public function listen(): Generator
    {
        while (!feof($this->socket)) {
            $response = $this->receive();

            if (!empty($response)) {
                yield $response;
            }
        }
    }
}
