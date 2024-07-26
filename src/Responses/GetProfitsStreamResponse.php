<?php

namespace Timirey\XApi\Responses;

use Timirey\XApi\Responses\Data\ProfitStreamRecord;

/**
 * readonly class that contains the response of the getProfits stream command.
 */
readonly class GetProfitsStreamResponse extends AbstractStreamResponse
{
    /**
     * Constructor for the GetProfitsStreamResponse class.
     *
     * @param  ProfitStreamRecord $profitStreamRecord Profit record data.
     */
    final public function __construct(public ProfitStreamRecord $profitStreamRecord)
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
        return new static(new ProfitStreamRecord(...$response['data']));
    }
}
