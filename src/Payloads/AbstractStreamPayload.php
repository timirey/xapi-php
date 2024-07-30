<?php

namespace Timirey\XApi\Payloads;

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
        $this->setParameter('streamSessionId', $streamSessionId);
    }

    /**
     * @inheritdoc
     */
    #[Override]
    public function toJson(): string
    {
        $payload['command'] = $this->getCommand();

        $parameters = $this->getParameters();

        if (!empty($parameters)) {
            $payload = array_merge($payload, $parameters);
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
