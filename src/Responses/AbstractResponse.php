<?php

namespace Timirey\XApi\Responses;

use InvalidArgumentException;
use JsonException;
use Timirey\XApi\Exceptions\ErrorResponseException;
use Timirey\XApi\Exceptions\InvalidResponseException;

/**
 * Abstract class for responses.
 */
abstract class AbstractResponse
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
     * @throws InvalidResponseException Thrown when the API response is invalid or incomplete.
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
     * @throws JsonException            Internal json exception.
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
     * @throws InvalidResponseException If the response cannot be processed.
     */
    protected static function validate(array &$data): void
    {
        if (! isset($data['status'])) {
            throw new InvalidResponseException('The response did not include a status.');
        }

        if ($data['status'] === false) {
            throw new ErrorResponseException($data['errorCode'], $data['errorDescr']);
        }

        unset($data['status']);
    }

    /**
     * Create a response instance from the validated data.
     *
     * @param array<string, mixed> $data Validated response data.
     *
     * @return static Instance of the response.
     */
    protected static function create(array $data): static
    {
        return new static(...($data['returnData'] ?? $data));
    }
}
