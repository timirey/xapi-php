<?php

namespace Timirey\XApi\Interfaces;

use Generator;
use Timirey\XApi\Exceptions\SocketException;

/**
 * Interface for payloads.
 */
interface ResponseInterface
{
    /**
     * Get the command.
     *
     * @return string Command name.
     */
    public function getCommand(): string;

    /**
     * Convert the object to JSON.
     *
     * @return string JSON representation of the payload.
     */
    public function toJson(): string;

    /**
     * Magic method for converting to string.
     *
     * @return string JSON representation of the payload.
     */
    public function __toString(): string;
}
