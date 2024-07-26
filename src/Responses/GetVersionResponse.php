<?php

namespace Timirey\XApi\Responses;

use Override;

/**
 * Class that contains the response of the getVersion command.
 */
final readonly class GetVersionResponse extends AbstractResponse
{
    /**
     * Constructor for GetVersionResponse.
     *
     * @param  string $version Current API version.
     */
    public function __construct(public string $version)
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
        return new self(...$response['returnData']);
    }
}
