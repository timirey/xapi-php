<?php

namespace Timirey\XApi\Connections;

use Generator;
use Timirey\XApi\Exceptions\SocketException;

/**
 * Represents a socket connection for sending and receiving data.
 */
class SocketConnection
{
    /**
     * @var string The delimiter for the socket messages.
     */
    protected const string DELIMITER = "\n\n";

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
    public function __construct(protected string $address)
    {
        $this->open();
    }

    /**
     * Destructor to close the socket.
     *
     * @throws SocketException If socket is not initialized.
     */
    public function __destruct()
    {
        $this->close();
    }

    /**
     * Opens the socket connection.
     *
     * @return boolean True on success, false on failure.
     * @throws SocketException If socket is not created.
     */
    public function open(): bool
    {
        $this->socket = stream_socket_client($this->address, $errorCode, $errorMessage);

        if ($this->socket === false) {
            throw new SocketException("$errorCode: $errorMessage");
        }

        return true;
    }

    /**
     * Sends data through the socket.
     *
     * @param string $payload The data to send.
     *
     * @return false|integer The number of bytes written, or false on failure.
     * @throws SocketException If socket is not accepting message.
     */
    public function send(string $payload): false|int
    {
        if ($this->socket === false) {
            throw new SocketException('The socket is not accepting messages.');
        }

        return fwrite($this->socket, $payload);
    }

    /**
     * Receives data from the socket until the delimiter "\n\n" is encountered.
     *
     * @return string The read data, or false on failure.
     * @throws SocketException If socket is not sending messages.
     */
    public function receive(): string
    {
        if ($this->socket === false) {
            throw new SocketException('The socket is not sending messages.');
        }

        $buffer = '';

        while ($chunk = fgets($this->socket)) {
            $buffer .= $chunk;

            $position = strpos($buffer, static::DELIMITER);

            if ($position !== false) {
                return substr($buffer, 0, $position);
            }
        }

        throw new SocketException('Failed to receive data from the socket.');
    }

    /**
     * Listen to the stream socket and yield data as it is received.
     *
     * @return Generator Yields data received from the socket.
     * @throws SocketException If socket is not able to subscribe the client.
     */
    public function listen(): Generator
    {
        if ($this->socket === false) {
            throw new SocketException('The socket is not subscribable.');
        }

        while (!feof($this->socket)) {
            $response = $this->receive();

            if ($response) {
                yield $response;
            }
        }

        throw new SocketException('The socket stream has been closed unexpectedly.');
    }

    /**
     * Closes the socket connection.
     *
     * @return boolean True on success, false on failure.
     * @throws SocketException If socket is already closed.
     */
    public function close(): bool
    {
        if ($this->socket === false) {
            throw new SocketException('The socket is already closed.');
        }

        return fclose($this->socket);
    }
}
