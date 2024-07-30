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
    public function __construct(int $userId, string $password, ?string $appName = null)
    {
        $this->setParameters([
            'userId' => $userId,
            'password' => $password
        ]);

        if ($appName !== null) {
            $this->setParameter('appName', $appName);
        }
    }

    /**
     * @inheritdoc
     */
    #[Override]
    protected function getCommand(): string
    {
        return 'login';
    }
}
