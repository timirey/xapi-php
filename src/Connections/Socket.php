<?php

namespace Timirey\XApi\Connections;

use Exception;
use Timirey\XApi\Exceptions\SocketException;

/**
 * Represents a socket connection for sending and receiving data.
 */
class Socket
{
    /**
     * @var false|resource The socket resource or false if failed to create.
     */
    protected $socket;

    /**
     * Constructor to initialize and connect the socket.
     *
     * @param string $address The address to connect to.
     *
     * @throws SocketException If socket is unable to init.
     */
    public function __construct(string $address)
    {
        $this->socket = stream_socket_client($address, $errorCode, $errorMessage);

        if ($this->socket === false) {
            throw new SocketException("$errorCode: $errorMessage");
        }
    }

    /**
     * Sends data through the socket.
     *
     * @param string $payload The data to send.
     *
     * @return false|integer The number of bytes written, or false on failure.
     */
    public function send(string $payload): false|int
    {
        return fwrite($this->socket, $payload);
    }

    /**
     * Receives data from the socket.
     *
     * @return false|string The read data, or false on failure.
     */
    public function receive(): false|string
    {
        return fgets($this->socket);
    }

    /**
     * Closes the socket connection.
     *
     * @return boolean True on success, false on failure.
     */
    public function close(): bool
    {
        return fclose($this->socket);
    }
}
