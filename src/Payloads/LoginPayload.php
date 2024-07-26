<?php

namespace Timirey\XApi\Payloads;

/**
 * Class that contains payload for the login command.
 */
class LoginPayload extends AbstractPayload
{
    /**
     * Constructor for LoginPayload.
     *
     * @param  integer $userId   User ID.
     * @param  string  $password User password.
     */
    public function __construct(int $userId, string $password)
    {
        $this->parameters['userId'] = $userId;
        $this->parameters['password'] = $password;
    }

    /**
     * Get the command.
     *
     * @return string Command name.
     */
    public function getCommand(): string
    {
        return 'login';
    }
}
