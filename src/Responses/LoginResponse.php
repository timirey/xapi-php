<?php

namespace Timirey\XApi\Responses;

/**
 * Class that contains the response of the login command.
 */
class LoginResponse extends AbstractResponse
{
    /**
     * Constructor for LoginResponse.
     *
     * @param  string $streamSessionId Stream session ID.
     */
    public function __construct(public string $streamSessionId)
    {
    }
}
