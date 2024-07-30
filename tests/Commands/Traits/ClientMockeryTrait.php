<?php

namespace Timirey\XApi\Tests\Commands\Traits;

use Generator;
use JsonException;
use Mockery;
use Mockery\MockInterface;
use Override;
use Timirey\XApi\Client;
use Timirey\XApi\Exceptions\InvalidPayloadException;
use Timirey\XApi\Payloads\AbstractStreamPayload;
use Timirey\XApi\Connections\SocketConnection;
use Timirey\XApi\Enums\Host;
use Timirey\XApi\Payloads\AbstractPayload;

/**
 * Trait ClientTrait.
 *
 * Provides setup and utility methods for mocking the socket client and handling API responses.
 *
 * @property MockInterface $request
 * @property MockInterface $stream
 * @property Client $client
 */
trait ClientMockeryTrait
{
    /**
     * Sets up the mocked socket client.
     *
     * This method should be called in the beforeEach() block of your tests.
     *
     * @param integer     $userId   User id.
     * @param string      $password Password.
     * @param Host        $host     Host URI.
     * @param string|null $appName  Application name.
     * @return void
     */
    public function mockClient(
        int $userId = 12345,
        string $password = 'password',
        Host $host = Host::DEMO,
        ?string $appName = 'App name'
    ): void {
        $this->request = Mockery::mock(SocketConnection::class);
        $this->stream = Mockery::mock(SocketConnection::class);

        $this->client = new class ($userId, $password, $host, $appName) extends Client {
            /**
             * Establishes connection to the xStation5 API.
             *
             * @return void
             */
            #[Override]
            protected function connect(): void
            {
                $this->streamSessionId = 'streamSessionId';
            }

            /**
             * Sets mocked socket connection.
             *
             * @param SocketConnection $request The socket connection.
             * @return void
             */
            public function setRequest(SocketConnection $request): void
            {
                $this->request = $request;
            }

            /**
             * Sets mocked socket connection.
             *
             * @param SocketConnection $stream The socket connection.
             * @return void
             */
            public function setStream(SocketConnection $stream): void
            {
                $this->stream = $stream;
            }
        };

        $this->client->setRequest($this->request);
        $this->client->setStream($this->stream);
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
        $this->request->shouldReceive('isConnected')
            ->once()
            ->andReturn(true);

        $this->request->shouldReceive('send')
            ->once()
            ->with($payload->toJson());

        $mockResponse = json_encode($response, JSON_THROW_ON_ERROR);

        $this->request->shouldReceive('receive')
            ->once()
            ->andReturn($mockResponse);
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
    public function mockStreamResponse(AbstractStreamPayload $payload, array $response): void
    {
        $this->request->shouldReceive('isConnected')
            ->once()
            ->andReturn(true);

        $this->stream->shouldReceive('send')
            ->once()
            ->with($payload->toJson());

        $mockResponse = json_encode($response, JSON_THROW_ON_ERROR);

        $this->stream->shouldReceive('listen')
            ->once()
            ->andReturn(call_user_func(static function () use ($mockResponse): Generator {
                yield $mockResponse;
            }));
    }
}
