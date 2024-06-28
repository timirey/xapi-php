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
     * @param string $userId User ID.
     * @param string $password User password.
     */
    public function __construct(
        string $userId,
        string $password
    ) {
        $this->arguments['userId'] = $userId;
        $this->arguments['password'] = $password;
    }

    /**
     * @inheritdoc
     */
    public function getCommand(): string
    {
        return 'login';
    }
}
