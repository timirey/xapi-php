<?php

namespace Timirey\XApi\Responses;

use Timirey\XApi\Responses\Data\TickStreamRecord;

/**
 * Class that contains the response of the getTickPrices stream command.
 */
class GetTickPricesStreamResponse extends AbstractStreamResponse
{
    /**
     * Constructor for the GetTickPricesStreamResponse class.
     *
     * @param  TickStreamRecord $tickStreamRecord Tick record data.
     */
    public function __construct(public TickStreamRecord $tickStreamRecord)
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
        return new static(new TickStreamRecord(...$response['data']));
    }
}
