<?php

namespace Timirey\XApi\Responses;

use Timirey\XApi\Responses\Data\StreamTradeStatusRecord;

/**
 * Class that contains the response of the getTradeStatus stream command.
 */
class GetTradeStatusStreamResponse extends AbstractStreamResponse
{
    /**
     * Constructor for the GetTradeStatusStreamResponse class.
     *
     * @param  StreamTradeStatusRecord $streamTradeStatusRecord Trade status record data.
     */
    public function __construct(public StreamTradeStatusRecord $streamTradeStatusRecord)
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
        return new static(new StreamTradeStatusRecord(...$response['data']));
    }
}
