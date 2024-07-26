<?php

namespace Timirey\XApi\Tests\Commands\Traits;

use JsonException;
use Mockery;
use Mockery\MockInterface;
use Override;
use Timirey\XApi\SocketClient;
use Timirey\XApi\Connections\SocketConnection;
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
        $this->socket = Mockery::mock(SocketConnection::class);

        $this->client = new class ($host) extends SocketClient {
            /**
             * Creates a new socket.
             *
             * @return void
             */
            #[Override]
            protected function init(): void
            {
            }

            /**
             * Sets the socket client.
             *
             * @param SocketConnection $socket Socket client.
             *
             * @return void
             */
            public function setSocket(SocketConnection $socket): void
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

        $mockResponse = json_encode($response, JSON_THROW_ON_ERROR);

        $this->socket->shouldReceive('receive')
            ->once()
            ->andReturn($mockResponse);
    }
}
