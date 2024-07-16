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
     * @param string     $address The address to connect to.
     * @param float|null $timeout The connection timeout in seconds.
     * @param integer    $flags   The flags to use for the connection.
     *
     * @throws SocketException If socket is unable to init.
     */
    public function __construct(
        string $address,
        ?float $timeout = 120,
        int $flags = STREAM_CLIENT_CONNECT
    ) {
        $this->socket = stream_socket_client(
            $address,
            $errorCode,
            $errorMessage,
            $timeout,
            $flags
        );

        if ($this->socket === false) {
            throw new SocketException("$errorCode: $errorMessage");
        }
    }

    /**
     * Sends data through the socket.
     *
     * @param string       $payload The data to send.
     * @param integer|null $length  The length of data to send. Defaults to the full length of the payload.
     *
     * @return false|integer The number of bytes written, or false on failure.
     */
    public function send(string $payload, ?int $length = null): false|int
    {
        return fwrite($this->socket, $payload, $length);
    }

    /**
     * Receives data from the socket.
     *
     * @param integer $length The maximum number of bytes to read.
     *
     * @return false|string The read data, or false on failure.
     */
    public function receive(int $length = 4096): false|string
    {
        return fread($this->socket, $length);
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
