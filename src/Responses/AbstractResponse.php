<?php

namespace Timirey\XApi\Responses;

use Timirey\XApi\Exceptions\ClientResponseException;

/**
 * Abstract class for responses.
 */
abstract class AbstractResponse
{
    /**
     * Create an instance from JSON.
     *
     * @param string $json JSON string.
     * @return static Instance of the response.
     * @throws ClientResponseException If the response indicates an error.
     */
    public static function instantiate(string $json): static
    {
        $data = json_decode($json, true);

        static::validate($data);

        return static::create($data);
    }

    /**
     * Validate the response data.
     *
     * @param array $data Response data.
     * @return void
     * @throws ClientResponseException If the response indicates an error.
     */
    protected static function validate(array &$data): void
    {
        if ($data['status'] === false) {
            throw new ClientResponseException($data['errorCode'], $data['errorDescr']);
        }

        unset($data['status']);
    }

    /**
     * Create a response instance from the validated data.
     *
     * @param array $data Validated response data.
     * @return static Instance of the response.
     */
    protected static function create(array $data): static
    {
        $returnData = $data['returnData'] ?? $data;

        return new static(...$returnData);
    }
}
