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

    /**
     * Create a response instance from the validated data.
     *
     * @param array<string, mixed> $response Validated response data.
     * @return static Instance of the response.
     */
    #[Override]
    protected static function create(array $response): self
    {
        return new self(...$response);
    }
}
