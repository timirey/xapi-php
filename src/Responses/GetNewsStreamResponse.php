<?php

namespace Timirey\XApi\Responses;

use Timirey\XApi\Responses\Data\NewsStreamRecord;

/**
 * Class that contains the response of the getNews stream command.
 */
final readonly class GetNewsStreamResponse extends AbstractStreamResponse
{
    /**
     * Constructor for the GetNewsStreamResponse class.
     *
     * @param  NewsStreamRecord $newsStreamRecord News record data.
     */
    public function __construct(public NewsStreamRecord $newsStreamRecord)
    {
    }

    /**
     * Create an instance from the validated data.
     *
     * @param  array<string, mixed> $response Validated response data.
     * @return static Instance of the response.
     */
    protected static function create(array $response): self
    {
        return new self(new NewsStreamRecord(...$response));
    }
}
