<?php

namespace Timirey\XApi\Responses;

/**
 * Class that contains the response of the login command.
 */
readonly class LoginResponse extends AbstractResponse
{
    /**
     * Constructor for LoginResponse.
     *
     * @param  string $streamSessionId Stream session ID.
     */
    final public function __construct(public string $streamSessionId)
    {
    }
}
