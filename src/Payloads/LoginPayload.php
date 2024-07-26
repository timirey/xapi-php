<?php

namespace Timirey\XApi\Payloads;

use Override;

/**
 * Class that contains payload for the login command.
 */
final class LoginPayload extends AbstractPayload
{
    /**
     * Constructor for LoginPayload.
     *
     * @param integer $userId   User ID.
     * @param string  $password User password.
     */
    public function __construct(int $userId, string $password)
    {
        $this->setParameters([
            'userId' => $userId,
            'password' => $password
        ]);
    }

    /**
     * Get the command.
     *
     * @return string Command name.
     */
    #[Override]
    protected function getCommand(): string
    {
        return 'login';
    }
}
