<?php

namespace Timirey\XApi\Tests\Commands\Traits;

use Generator;
use JsonException;
use Mockery;
use Mockery\MockInterface;
use Timirey\XApi\Connections\StreamSocket;
use Timirey\XApi\Enums\Host;
use Timirey\XApi\Enums\StreamHost;
use Timirey\XApi\Exceptions\InvalidPayloadException;
use Timirey\XApi\Payloads\AbstractStreamPayload;
use Timirey\XApi\StreamClient;

/**
 * Trait StreamClientMockeryTrait.
 *
 * Provides setup and utility methods for mocking the WebSocket stream client and handling API responses.
 *
 * @property MockInterface $streamSocket
 * @property StreamClient $streamClient
 */
trait StreamClientMockeryTrait
{
    /**
     * Sets up the mocked WebSocket stream client and message.
     *
     * This method should be called in the beforeEach() block of your tests.
     *
     * @param string     $streamSessionId Stream session ID.
     * @param StreamHost $host            Host URI.
     *
     * @return void
     */
    public function mockStreamClient(
        string $streamSessionId = 'streamSessionId',
        StreamHost $host = StreamHost::DEMO
    ): void {
        $this->streamSocket = Mockery::mock(StreamSocket::class);

        $this->streamClient = new class ($streamSessionId, $host) extends StreamClient {
            /**
             * Override the constructor to prevent creating a new stream socket instance.
             *
             * @param string     $streamSessionId Stream session ID.
             * @param StreamHost $host            WebSocket host URL.
             *
             * @noinspection PhpMissingParentConstructorInspection
             */
            public function __construct(protected string $streamSessionId, protected StreamHost $host)
            {
            }

            /**
             * Sets the stream socket client.
             *
             * @param StreamSocket $streamSocket Stream socket client.
             *
             * @return void
             */
            public function setStreamSocket(StreamSocket $streamSocket): void
            {
                $this->streamSocket = $streamSocket;
            }
        };

        $this->streamClient->setStreamSocket($this->streamSocket);
    }

    /**
     * Mocks the WebSocket response for a given payload.
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
        $this->streamSocket->shouldReceive('send')
            ->once()
            ->with($payload->toJson());

        $mockResponse = json_encode($response);

        $this->streamSocket->shouldReceive('listen')
            ->once()
            ->andReturn(call_user_func(static function () use ($mockResponse): Generator {
                yield $mockResponse;
            }));
    }
}
