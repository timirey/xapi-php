<?php

namespace Timirey\XApi\Tests\Commands\Traits;

use JsonException;
use Mockery;
use Mockery\MockInterface;
use Timirey\XApi\Exceptions\InvalidPayloadException;
use Timirey\XApi\StreamClient;
use Timirey\XApi\Enums\StreamHost;
use Timirey\XApi\Payloads\AbstractStreamPayload;
use WebSocket\Client as WebSocketClient;
use WebSocket\Message\Message;

/**
 * Trait StreamClientMockeryTrait.
 *
 * Provides setup and utility methods for mocking the WebSocket stream client and handling API responses.
 *
 * @property MockInterface $streamClient
 * @property MockInterface $message
 * @property StreamClient  $client
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
     */
    public function mockStreamClient(string $streamSessionId = 'streamSessionId', StreamHost $host = StreamHost::DEMO): void
    {
        $this->streamClient = Mockery::mock(WebSocketClient::class);
        $this->message = Mockery::mock(Message::class);

        $this->client = new class ($streamSessionId, $host) extends StreamClient {
            /**
             * Sets the WebSocket client.
             *
             * @param WebSocketClient $client WebSocket client.
             */
            public function setStreamClient(WebSocketClient $client): void
            {
                $this->streamClient = $client;
            }
        };

        $this->client->setStreamClient($this->streamClient);
    }

    /**
     * Mocks the WebSocket response for a given payload.
     *
     * @param AbstractStreamPayload $payload  The payload to be sent.
     * @param array                 $response The mocked response data.
     *
     * @throws JsonException           If encoding to JSON fails.
     * @throws InvalidPayloadException If payload is missing or invalid.
     */
    public function mockStreamResponse(AbstractStreamPayload $payload, array $response): void
    {
        $this->streamClient->shouldReceive('text')
            ->once()
            ->with($payload->toJson());

        $mockResponse = json_encode($response);

        $this->streamClient->shouldReceive('receive')
            ->once()
            ->andReturn($this->message);

        $this->message->shouldReceive('getContent')
            ->once()
            ->andReturn($mockResponse);
    }
}
