<?php

namespace Timirey\XApi\Responses;

use Override;

/**
 * Class that contains the response of the ping command.
 */
final readonly class PingResponse extends AbstractResponse
{
    /**
     * Create a response instance from the validated data.
     *
     * @param array<string, mixed> $response Validated response data.
     * @return static Instance of the response.
     */
    #[Override]
    protected static function create(array $response): self
    {
        return new self();
    }
}
