<?php

namespace Timirey\XApi\Tests\Commands\Traits;

use Generator;
use JsonException;
use Mockery;
use Mockery\MockInterface;
use Override;
use Timirey\XApi\Connections\SocketConnection;
use Timirey\XApi\Enums\Host;
use Timirey\XApi\Exceptions\InvalidPayloadException;
use Timirey\XApi\Payloads\AbstractStreamPayload;
use Timirey\XApi\StreamClient;

/**
 * Trait StreamClientMockeryTrait.
 *
 * Provides setup and utility methods for mocking the stream socket client and handling API responses.
 *
 * @property MockInterface $socket
 * @property StreamClient $client
 */
trait StreamClientMockeryTrait
{
    /**
     * Sets up the mocked stream socket client and message.
     *
     * This method should be called in the beforeEach() block of your tests.
     *
     * @param string $streamSessionId Stream session ID.
     * @param Host   $host            Host URI.
     *
     * @return void
     */
    public function mockClient(
        string $streamSessionId = 'streamSessionId',
        Host $host = Host::DEMO
    ): void {
        $this->socket = Mockery::mock(SocketConnection::class);

        $this->client = new class ($streamSessionId, $host) extends StreamClient {
            /**
             * Creates new stream socket.
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
     * @param AbstractStreamPayload $payload  The payload to be sent.
     * @param array                 $response The mocked response data.
     *
     * @return void
     * @throws InvalidPayloadException If payload is missing or invalid.
     *
     * @throws JsonException If encoding to JSON fails.
     */
    public function mockResponse(AbstractStreamPayload $payload, array $response): void
    {
        $this->socket->shouldReceive('send')
            ->once()
            ->with($payload->toJson());

        $mockResponse = json_encode($response, JSON_THROW_ON_ERROR);

        $this->socket->shouldReceive('listen')
            ->once()
            ->andReturn(call_user_func(static function () use ($mockResponse): Generator {
                yield $mockResponse;
            }));
    }
}
