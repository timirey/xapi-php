<?php

namespace Timirey\XApi\Connections;

use Generator;
use Override;
use Timirey\XApi\Exceptions\SocketException;
use Timirey\XApi\Interfaces\ConnectionInterface;

/**
 * Represents a socket connection for sending and receiving data.
 */
final class SocketConnection implements ConnectionInterface
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
     * Opens the socket connection.
     *
     * @return boolean True on success, false on failure.
     * @throws SocketException If socket is not initialized.
     */
    #[Override]
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
     * @throws SocketException If socket is not initialized.
     */
    #[Override]
    public function send(string $payload): false|int
    {
        if ($this->socket === false) {
            throw new SocketException('The socket is not initialized.');
        }

        return fwrite($this->socket, $payload);
    }

    /**
     * Receives data from the socket until the delimiter "\n\n" is encountered.
     *
     * @return string The read data, or false on failure.
     * @throws SocketException If socket is not initialized.
     */
    #[Override]
    public function receive(): string
    {
        if ($this->socket === false) {
            throw new SocketException('The socket is not initialized.');
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
     * @throws SocketException If socket is empty or not initialized.
     */
    #[Override]
    public function listen(): Generator
    {
        if ($this->socket === false) {
            throw new SocketException('The socket is not initialized.');
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
     * @throws SocketException If socket is not initialized.
     */
    #[Override]
    public function close(): bool
    {
        if ($this->socket === false) {
            throw new SocketException('The socket is not initialized.');
        }

        return fclose($this->socket);
    }
}
