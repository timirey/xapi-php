<?php

namespace Timirey\XApi\Responses;

use InvalidArgumentException;
use JsonException;
use Timirey\XApi\Exceptions\ErrorResponseException;
use Timirey\XApi\Exceptions\InvalidResponseException;

/**
 * Abstract class for responses.
 */
abstract readonly class AbstractResponse
{
    /**
     * Create an instance from JSON.
     *
     * @param string $json JSON string.
     * @return static Instance of the response.
     *
     * @throws ErrorResponseException If the response indicates an error.
     * @throws JsonException If the response cannot be processed.
     * @throws InvalidResponseException Thrown when the API response is invalid or incomplete.
     */
    public static function instantiate(string $json): self
    {
        $data = static::parseJson($json);

        static::validate($data);

        static::mutate($data);

        return static::create($data);
    }

    /**
     * Decode JSON string.
     *
     * @param string $json JSON string.
     * @return array<string, mixed> Decoded JSON data.
     *
     * @throws InvalidArgumentException If the JSON is invalid.
     * @throws JsonException Internal json exception.
     */
    protected static function parseJson(string $json): array
    {
        return json_decode($json, true, flags: JSON_THROW_ON_ERROR);
    }

    /**
     * Validate the response data.
     *
     * @param array<string, mixed> $response Response data.
     *
     * @return void
     * @throws InvalidResponseException If the response cannot be processed.
     *
     * @throws ErrorResponseException If the response indicates an error or status is missing.
     */
    protected static function validate(array &$response): void
    {
        if (!isset($response['status'])) {
            throw new InvalidResponseException('The response did not include a status.');
        }

        if ($response['status'] === false) {
            throw new ErrorResponseException($response['errorCode'], $response['errorDescr']);
        }

        unset($response['status']);
    }

    /**
     * Mutate the response data to simplify its structure.
     *
     * @param array<string, mixed> $response Response data.
     *
     * @return void
     */
    protected static function mutate(array &$response): void
    {
        $response = $response['data'] ?? $response['returnData'] ?? $response;
    }

    /**
     * Create a response instance from the validated data.
     *
     * @param array<string, mixed> $response Validated response data.
     * @return static Instance of the response.
     */
    protected static function create(array $response): self
    {
        /** @phpstan-ignore-next-line */
        return new static(...$response);
    }
}
