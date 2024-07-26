<?php

namespace Timirey\XApi\Responses;

use InvalidArgumentException;
use JsonException;
use Override;
use Timirey\XApi\Exceptions\ErrorResponseException;
use Timirey\XApi\Exceptions\InvalidResponseException;

/**
 * Abstract class for streaming responses.
 */
abstract readonly class AbstractStreamResponse extends AbstractResponse
{
    /**
     * Validate the response data.
     *
     * @param  array<string, mixed> $response Response data.
     *
     * @throws InvalidResponseException If the response is invalid or incomplete.
     *
     * @return void
     */
    #[Override]
    protected static function validate(array &$response): void
    {
        if (! isset($response['command'])) {
            throw new InvalidResponseException('The response did not include a command.');
        }

        unset($response['command']);
    }
}
