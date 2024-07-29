<?php

namespace Timirey\XApi\Responses;

use Override;

/**
 * Class that contains the response of the login command.
 */
final readonly class LoginResponse extends AbstractResponse
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
