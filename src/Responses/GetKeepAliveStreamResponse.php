<?php

namespace Timirey\XApi\Responses;

use Timirey\XApi\Responses\Data\StreamKeepAliveRecord;

/**
 * Class that contains the response of the getKeepAlive stream command.
 */
class GetKeepAliveStreamResponse extends AbstractStreamResponse
{
    /**
     * Constructor for the GetKeepAliveStreamResponse class.
     *
     * @param StreamKeepAliveRecord $streamKeepAliveRecord Keep alive record data.
     */
    public function __construct(public StreamKeepAliveRecord $streamKeepAliveRecord)
    {
    }

    /**
     * Create an instance from the validated data.
     *
     * @param array<string, mixed> $response Validated response data.
     *
     * @return static Instance of the response.
     */
    protected static function create(array $response): static
    {
        return new static(new StreamKeepAliveRecord(...$response['data']));
    }
}
