<?php

namespace Timirey\XApi\Payloads;

use JsonException;
use Override;
use Timirey\XApi\Interfaces\PayloadInterface;

/**
 * Abstract class for payloads.
 */
abstract class AbstractPayload implements PayloadInterface
{
    /**
     * Array of parameters used in payload.
     *
     * @var array<string, mixed>
     */
    public array $parameters = [];

    /**
     * Convert the object to JSON.
     *
     * @return string JSON representation of the payload.
     *
     * @throws JsonException If encoding to JSON fails.
     */
    #[Override]
    public function toJson(): string
    {
        $payload['command'] = $this->getCommand();

        if (! empty($this->parameters)) {
            $payload['arguments'] = $this->parameters;
        }

        return json_encode($payload, JSON_THROW_ON_ERROR);
    }

    /**
     * Magic method for converting to string.
     *
     * @return string JSON representation of the payload.
     *
     * @throws JsonException If encoding to JSON fails.
     */
    #[Override]
    public function __toString(): string
    {
        return $this->toJson();
    }
}
