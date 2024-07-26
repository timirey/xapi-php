<?php

namespace Timirey\XApi\Payloads;

use JsonException;

/**
 * Abstract class for payloads.
 */
abstract class AbstractPayload
{
    /**
     * Array of parameters used in payload.
     *
     * @var array<string, mixed>
     */
    protected array $parameters = [];

    /**
     * Convert the object to JSON.
     *
     * @return string JSON representation of the payload.
     *
     * @throws JsonException If encoding to JSON fails.
     */
    public function toJson(): string
    {
        $payload['command'] = $this->getCommand();

        $parameters = $this->getParameters();

        if (!empty($parameters)) {
            $payload['arguments'] = $parameters;
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
    public function __toString(): string
    {
        return $this->toJson();
    }

    /**
     * Get a specific parameter.
     *
     * @param string $key Parameter key.
     * @return mixed|null Parameter value or null if not set.
     */
    public function getParameter(string $key): mixed
    {
        return $this->parameters[$key] ?? null;
    }

    /**
     * Get all parameters.
     *
     * @return array<string, mixed> Parameters.
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * Set a parameter.
     *
     * @param string $key   Parameter key.
     * @param mixed  $value Parameter value.
     * @return void
     */
    public function setParameter(string $key, mixed $value): void
    {
        $this->parameters[$key] = $value;
    }

    /**
     * Set multiple parameters.
     *
     * @param array<string, mixed> $values Parameters.
     * @return void
     */
    public function setParameters(array $values): void
    {
        foreach ($values as $key => $value) {
            $this->parameters[$key] = $value;
        }
    }

    /**
     * Remove a parameter.
     *
     * @param string $key Parameter key.
     * @return void
     */
    public function removeParameter(string $key): void
    {
        unset($this->parameters[$key]);
    }

    /**
     * Remove all parameters.
     *
     * @return void
     */
    public function removeParameters(): void
    {
        $this->parameters = [];
    }

    /**
     * Get the command.
     *
     * @return string Command name.
     */
    abstract protected function getCommand(): string;
}
