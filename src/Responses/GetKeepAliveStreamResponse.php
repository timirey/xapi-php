<?php

namespace Timirey\XApi\Responses;

use Timirey\XApi\Responses\Data\KeepAliveStreamRecord;

/**
 * Class that contains the response of the getKeepAlive stream command.
 */
readonly class GetKeepAliveStreamResponse extends AbstractStreamResponse
{
    /**
     * Constructor for the GetKeepAliveStreamResponse class.
     *
     * @param  KeepAliveStreamRecord $keepAliveStreamRecord Keep alive record data.
     */
    final public function __construct(public KeepAliveStreamRecord $keepAliveStreamRecord)
    {
    }

    /**
     * Create an instance from the validated data.
     *
     * @param  array<string, mixed> $response Validated response data.
     * @return static Instance of the response.
     */
    protected static function create(array $response): static
    {
        return new static(new KeepAliveStreamRecord(...$response['data']));
    }
}
