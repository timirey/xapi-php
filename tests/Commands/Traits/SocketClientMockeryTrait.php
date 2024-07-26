<?php

namespace Timirey\XApi\Tests\Commands\Traits;

use JsonException;
use Mockery;
use Mockery\MockInterface;
use Timirey\XApi\SocketClient;
use Timirey\XApi\Connections\Socket;
use Timirey\XApi\Enums\Host;
use Timirey\XApi\Payloads\AbstractPayload;

/**
 * Trait ClientTrait.
 *
 * Provides setup and utility methods for mocking the socket client and handling API responses.
 *
 * @property MockInterface $socket
 * @property SocketClient $client
 */
trait SocketClientMockeryTrait
{
    /**
     * Sets up the mocked socket client.
     *
     * This method should be called in the beforeEach() block of your tests.
     *
     * @param integer $userId   User id.
     * @param string  $password Password.
     * @param Host    $host     Host URI.
     *
     * @return void
     */
    public function mockClient(int $userId = 12345, string $password = 'password', Host $host = Host::DEMO): void
    {
        $this->socket = Mockery::mock(Socket::class);

        $this->client = new class ($userId, $password, $host) extends SocketClient {
            /**
             * Override the constructor to prevent creating a new Socket instance.
             *
             * @param integer $userId   User ID.
             * @param string  $password User password.
             * @param Host    $host     Socket host URL.
             *
             * @noinspection PhpMissingParentConstructorInspection
             */
            public function __construct(protected int $userId, protected string $password, protected Host $host)
            {
            }

            /**
             * Sets the socket client.
             *
             * @param Socket $socket Socket client.
             *
             * @return void
             */
            public function setSocket(Socket $socket): void
            {
                $this->socket = $socket;
            }
        };

        $this->client->setSocket($this->socket);
    }

    /**
     * Mocks the socket response for a given payload.
     *
     * @param AbstractPayload $payload  The payload to be sent.
     * @param array           $response The mocked response data.
     *
     * @return void
     * @throws JsonException If encoding to JSON fails.
     *
     */
    public function mockResponse(AbstractPayload $payload, array $response): void
    {
        $this->socket->shouldReceive('send')
            ->once()
            ->with($payload->toJson());

        $mockResponse = json_encode($response);

        $this->socket->shouldReceive('receive')
            ->once()
            ->andReturn($mockResponse);
    }
}
