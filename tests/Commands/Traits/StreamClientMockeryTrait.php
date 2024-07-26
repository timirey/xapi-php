<?php

namespace Timirey\XApi\Tests\Commands\Traits;

use Generator;
use JsonException;
use Mockery;
use Mockery\MockInterface;
use Timirey\XApi\Connections\Stream;
use Timirey\XApi\Enums\Host;
use Timirey\XApi\Enums\StreamHost;
use Timirey\XApi\Exceptions\InvalidPayloadException;
use Timirey\XApi\Payloads\AbstractStreamPayload;
use Timirey\XApi\StreamClient;

/**
 * Trait StreamClientMockeryTrait.
 *
 * Provides setup and utility methods for mocking the stream socket client and handling API responses.
 *
 * @property MockInterface $stream
 * @property StreamClient $streamClient
 */
trait StreamClientMockeryTrait
{
    /**
     * Sets up the mocked stream socket client and message.
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
        $this->stream = Mockery::mock(Stream::class);

        $this->streamClient = new class ($streamSessionId, $host) extends StreamClient {
            /**
             * Override the constructor to prevent creating a new stream socket instance.
             *
             * @param string     $streamSessionId Stream session ID.
             * @param StreamHost $host            Host URL.
             *
             * @noinspection PhpMissingParentConstructorInspection
             */
            public function __construct(protected string $streamSessionId, protected StreamHost $host)
            {
            }

            /**
             * Sets the stream socket client.
             *
             * @param Stream $stream Stream socket client.
             *
             * @return void
             */
            public function setStream(Stream $stream): void
            {
                $this->stream = $stream;
            }
        };

        $this->streamClient->setStream($this->stream);
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
        $this->stream->shouldReceive('send')
            ->once()
            ->with($payload->toJson());

        $mockResponse = json_encode($response);

        $this->stream->shouldReceive('listen')
            ->once()
            ->andReturn(call_user_func(static function () use ($mockResponse): Generator {
                yield $mockResponse;
            }));
    }
}
