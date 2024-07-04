<?php

namespace Timirey\XApi\Responses;

use Timirey\XApi\Responses\Data\NewsTopicRecord;

/**
 * Class that contains the response of the getNews command.
 */
class GetNewsResponse extends AbstractResponse
{
    /**
     * Constructor for GetNewsResponse.
     *
     * @param  NewsTopicRecord[]  $newsTopicRecords  NewsTopicRecord instances.
     */
    public function __construct(public array $newsTopicRecords)
    {
    }

    /**
     * Create a response instance from the validated data.
     *
     * @param  array  $data  Validated response data.
     * @return static Instance of the response.
     */
    protected static function create(array $data): static
    {
        return new static(array_map(
            static fn (array $newsTopicRecordData): NewsTopicRecord => new NewsTopicRecord(...$newsTopicRecordData),
            $data['returnData']
        ));
    }
}
