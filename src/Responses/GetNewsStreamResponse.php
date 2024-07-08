<?php

namespace Timirey\XApi\Responses;

use Timirey\XApi\Responses\Data\StreamNewsRecord;

/**
 * Class that contains the response of the getNews stream command.
 */
class GetNewsStreamResponse extends AbstractStreamResponse
{
    /**
     * Constructor for the GetNewsStreamResponse class.
     *
     * @param StreamNewsRecord $streamNewsRecord News record data.
     */
    public function __construct(public StreamNewsRecord $streamNewsRecord)
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
        return new static(new StreamNewsRecord(...$response['data']));
    }
}
