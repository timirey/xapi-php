<?php

namespace Timirey\XApi\Payloads;

/**
 * Abstract class for payloads.
 *
 * todo: add setArgument(s) method, to avoid direct array modification.
 */
abstract class AbstractPayload
{
    /**
     * Array of arguments used in payload.
     *
     * @var string[]
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
     */
    public function toJson(): string
    {
        $payload['command'] = $this->getCommand();

        if (!empty($this->arguments)) {
            $payload['arguments'] = $this->arguments;
        }

        return json_encode($payload);
    }

    /**
     * Magic method for converting to string.
     *
     * @return string JSON representation of the payload.
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
