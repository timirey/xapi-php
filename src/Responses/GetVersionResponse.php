<?php

namespace Timirey\XApi\Responses;

/**
 * Class that contains the response of the getVersion command.
 */
class GetVersionResponse extends AbstractResponse
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
