<?php

namespace Timirey\XApi\Responses;

use InvalidArgumentException;
use JsonException;
use Timirey\XApi\Exceptions\ErrorResponseException;
use Timirey\XApi\Exceptions\InvalidResponseException;

/**
 * Abstract class for streaming responses.
 */
abstract class AbstractStreamResponse
{
    /**
     * Create an instance from JSON.
     *
     * @param string $json JSON string.
     *
     * @return static Instance of the response.
     *
     * @throws ErrorResponseException   If the response indicates an error.
     * @throws JsonException            If the response cannot be processed.
     * @throws InvalidResponseException If the response is invalid or incomplete.
     */
    public static function instantiate(string $json): static
    {
        $data = self::parseJson($json);

        self::validate($data);

        return static::create($data);
    }

    /**
     * Decode JSON string.
     *
     * @param string $json JSON string.
     *
     * @return array<string, mixed> Decoded JSON data.
     *
     * @throws InvalidArgumentException If the JSON is invalid.
     * @throws JsonException            Internal JSON exception.
     */
    protected static function parseJson(string $json): array
    {
        return json_decode($json, true, flags: JSON_THROW_ON_ERROR);
    }

    /**
     * Validate the response data.
     *
     * @param array<string, mixed> $data Response data.
     *
     * @throws ErrorResponseException   If the response indicates an error or status is missing.
     * @throws InvalidResponseException If the response is invalid or incomplete.
     */
    protected static function validate(array &$data): void
    {
        if (! isset($data['command'])) {
            throw new InvalidResponseException('The response did not include a command.');
        }

        unset($data['command']);
    }

    /**
     * Create a response instance from the validated data.
     *
     * @param array<string, mixed> $response Validated response data.
     *
     * @return static Instance of the response.
     */
    protected static function create(array $response): static
    {
        return new static(...($response['data'] ?? $response));
    }
}
