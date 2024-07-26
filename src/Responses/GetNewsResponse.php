<?php

namespace Timirey\XApi\Responses;

use Timirey\XApi\Responses\Data\NewsTopicRecord;

/**
 * Class that contains the response of the getNews command.
 */
readonly class GetNewsResponse extends AbstractResponse
{
    /**
     * Constructor for GetNewsResponse.
     *
     * @param  NewsTopicRecord[] $newsTopicRecords NewsTopicRecord instances.
     */
    final public function __construct(public array $newsTopicRecords)
    {
    }

    /**
     * Create a response instance from the validated data.
     *
     * @param  array<string, mixed> $response Validated response data.
     * @return static Instance of the response.
     */
    protected static function create(array $response): static
    {
        return new static(array_map(
            static fn (array $newsTopicRecordData): NewsTopicRecord => new NewsTopicRecord(...$newsTopicRecordData),
            $response['returnData']
        ));
    }
}
