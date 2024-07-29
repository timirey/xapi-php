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
}
