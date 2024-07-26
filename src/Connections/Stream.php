<?php

namespace Timirey\XApi\Connections;

use Generator;
use Timirey\XApi\Exceptions\SocketException;

/**
 * Extends the Socket class to provide additional functionality for
 * listening to data from a stream socket connection.
 */
class Stream extends Socket
{
    /**
     * Listen to the stream socket and yield data as it is received.
     *
     * @return Generator Yields data received from the socket.
     * @throws SocketException If socket is empty.
     */
    public function listen(): Generator
    {
        while (!feof($this->socket)) {
            $response = $this->receive();

            if ($response) {
                yield $response;
            }
        }

        throw new SocketException('The socket stream has been closed unexpectedly.');
    }
}
