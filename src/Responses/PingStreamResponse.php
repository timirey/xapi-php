<?php

namespace Timirey\XApi\Responses;

use Override;

/**
 * Class representing a dummy response for the ping stream command.
 */
final readonly class PingStreamResponse extends AbstractStreamResponse
{
    /**
     * Create a response instance from the validated data.
     *
     * @param  array<string, mixed> $response Validated response data.
     * @return static Instance of the response.
     */
    #[Override]
    protected static function create(array $response): self
    {
        return new self();
    }
}
