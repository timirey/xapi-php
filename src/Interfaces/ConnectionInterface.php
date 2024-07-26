<?php

namespace Timirey\XApi\Interfaces;

use Generator;
use Timirey\XApi\Exceptions\SocketException;

/**
 * Interface for socket connection.
 */
interface ConnectionInterface
{
    /**
     * Opens the socket connection.
     *
     * @return boolean True on success, false on failure.
     */
    public function open(): bool;

    /**
     * Sends data through the socket.
     *
     * @param string $payload The data to send.
     *
     * @return false|integer The number of bytes written, or false on failure.
     */
    public function send(string $payload): false|int;

    /**
     * Receives data from the socket until the delimiter "\n\n" is encountered.
     *
     * @return string The read data, or false on failure.
     */
    public function receive(): string;

    /**
     * Listen to the stream socket and yield data as it is received.
     *
     * @return Generator Yields data received from the socket.
     * @throws SocketException If socket is empty or not initialized.
     */
    public function listen(): Generator;

    /**
     * Closes the socket connection.
     *
     * @return boolean True on success, false on failure.
     */
    public function close(): bool;
}
