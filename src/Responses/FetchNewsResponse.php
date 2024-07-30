<?php

namespace Timirey\XApi\Responses;

use Override;
use Timirey\XApi\Responses\Data\NewsStreamRecord;

/**
 * Class that contains the response of the fetchNews stream command.
 */
final readonly class FetchNewsResponse extends AbstractStreamResponse
{
    /**
     * Constructor for the FetchNewsResponse class.
     *
     * @param  NewsStreamRecord $newsStreamRecord News record data.
     */
    public function __construct(public NewsStreamRecord $newsStreamRecord)
    {
    }

    /**
     * @inheritdoc
     */
    #[Override]
    protected static function create(array $response): self
    {
        return new self(new NewsStreamRecord(...$response));
    }
}
