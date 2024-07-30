<?php

namespace Timirey\XApi\Responses;

use Override;
use Timirey\XApi\Exceptions\InvalidResponseException;

/**
 * Abstract class for streaming responses.
 */
abstract readonly class AbstractStreamResponse extends AbstractResponse
{
    /**
     * @inheritdoc
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
