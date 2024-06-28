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
     * @param NewsTopicRecord[] $news
     */
    public function __construct(public array $news)
    {
    }

    /**
     * @inheritdoc
     */
    protected static function create(array $data): static
    {
        $newsTopicRecords = array_map(function ($newsTopicRecordData) {
            return new NewsTopicRecord(...$newsTopicRecordData);
        }, $data['returnData']);

        return new static($newsTopicRecords);
    }
}
