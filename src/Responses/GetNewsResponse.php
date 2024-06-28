<?php

namespace Timirey\XApi\Responses;

use Timirey\XApi\Responses\Data\NewsTopicRecord;
use Timirey\XApi\Responses\Data\SymbolRecord;

/**
 * Class that contains the response of the getNews command.
 */
class GetNewsResponse extends AbstractResponse
{
    /**
     * Constructor for GetNewsResponse.
     *
     * @param NewsTopicRecord[] $newsTopicRecords
     */
    public function __construct(
        public array $newsTopicRecords
    ) {
    }

    /**
     * @inheritdoc
     */
    protected static function create(array $data): static
    {
        return new static(
            newsTopicRecords: array_map(
                static fn(array $newsTopicRecordData): NewsTopicRecord => new NewsTopicRecord(...$newsTopicRecordData),
                $data['returnData']
            )
        );
    }
}
