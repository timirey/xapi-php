<?php

namespace Timirey\XApi\Responses;

use Override;

/**
 * Class that contains the response of the logout command.
 */
final readonly class LogoutResponse extends AbstractResponse
{
    /**
     * @inheritdoc
     */
    #[Override]
    protected static function create(array $response): self
    {
        return new self();
    }
}
