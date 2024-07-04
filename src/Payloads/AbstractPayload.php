<?php

namespace Timirey\XApi\Payloads;

use JsonException;

/**
 * Abstract class for payloads.
 */
abstract class AbstractPayload
{
    /**
     * Array of arguments used in payload.
     *
     * @var array<string>
     */
    public array $arguments = [];

    /**
     * Get the command.
     *
     * @return string Command name.
     */
    abstract public function getCommand(): string;

    /**
     * Convert the object to JSON.
     *
     * @return string JSON representation of the payload.
     * @throws JsonException If encoding to JSON fails.
     */
    public function toJson(): string
    {
        $payload['command'] = $this->getCommand();

        if (!empty($this->arguments)) {
            $payload['arguments'] = $this->arguments;
        }

        return json_encode($payload, JSON_THROW_ON_ERROR);
    }

    /**
     * Magic method for converting to string.
     *
     * @return string JSON representation of the payload.
     * @throws JsonException If encoding to JSON fails.
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
