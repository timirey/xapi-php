<?php

namespace Timirey\XApi\Tests\Commands\Traits;

use JsonException;
use Mockery;
use Mockery\MockInterface;
use Timirey\XApi\Client;
use Timirey\XApi\Enums\Host;
use Timirey\XApi\Payloads\AbstractPayload;
use WebSocket\Client as WebSocketClient;
use WebSocket\Message\Message;

/**
 * Trait ClientTrait.
 *
 * Provides setup and utility methods for mocking the WebSocket client and handling API responses.
 *
 * @property MockInterface $webSocketClient
 * @property MockInterface $message
 * @property Client        $client
 */
trait MockeryTrait
{
    /**
     * Sets up the mocked WebSocket client and message.
     *
     * This method should be called in the beforeEach() block of your tests.
     *
     * @param int    $userId   User id.
     * @param string $password Password.
     * @param Host   $host     Host URI.
     */
    public function mockClient(int $userId = 12345, string $password = 'password', Host $host = Host::DEMO): void
    {
        $this->webSocketClient = Mockery::mock(WebSocketClient::class);
        $this->message = Mockery::mock(Message::class);

        $this->client = new class ($userId, $password, $host) extends Client {
            /**
             * Sets the WebSocket client.
             *
             * @param WebSocketClient $client WebSocket client.
             */
            public function setWebSocketClient(WebSocketClient $client): void
            {
                $this->client = $client;
            }
        };

        $this->client->setWebSocketClient($this->webSocketClient);
    }

    /**
     * Mocks the WebSocket response for a given payload.
     *
     * @param AbstractPayload $payload  The payload to be sent.
     * @param array           $response The mocked response data.
     *
     * @throws JsonException If encoding to JSON fails.
     */
    public function mockResponse(AbstractPayload $payload, array $response): void
    {
        $this->webSocketClient->shouldReceive('text')
            ->once()
            ->with($payload->toJson());

        $mockResponse = json_encode($response);

        $this->webSocketClient->shouldReceive('receive')
            ->once()
            ->andReturn($this->message);

        $this->message->shouldReceive('getContent')
            ->once()
            ->andReturn($mockResponse);
    }
}
