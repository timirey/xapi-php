<?php

namespace Timirey\XApi\Payloads;

use JsonException;
use Override;
use Timirey\XApi\Exceptions\InvalidPayloadException;

/**
 * Abstract class for streaming payloads.
 */
abstract class AbstractStreamPayload extends AbstractPayload
{
    /**
     * Constructor for AbstractStreamPayload.
     *
     * @param string $streamSessionId Stream session id.
     */
    public function __construct(string $streamSessionId)
    {
        $this->parameters['streamSessionId'] = $streamSessionId;
    }

    /**
     * Convert the object to JSON.
     *
     * @return string JSON representation of the payload.
     *
     * @throws JsonException If encoding to JSON fails.
     * @throws InvalidPayloadException If payload is not valid.
     */
    #[Override]
    public function toJson(): string
    {
        $payload['command'] = $this->getCommand();

        if (!empty($this->parameters)) {
            $payload = array_merge($payload, $this->parameters);
        }

        if (!isset($payload['streamSessionId'])) {
            throw new InvalidPayloadException('The payload did not include a streamSessionId.');
        }

        if (empty($payload['streamSessionId'])) {
            throw new InvalidPayloadException('The streamSessionId provided in the payload is empty.');
        }

        return json_encode($payload, JSON_THROW_ON_ERROR);
    }
}
