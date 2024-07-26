<?php

namespace Timirey\XApi\Responses;

use Timirey\XApi\Responses\Data\TickRecord;

/**
 * Class that contains the response of the getTickPrices command.
 */
readonly class GetTickPricesResponse extends AbstractResponse
{
    /**
     * Constructor for GetTickPricesResponse.
     *
     * @param  TickRecord[] $quotations TickRecord instances, aka Quotations.
     */
    final public function __construct(public array $quotations)
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
            static fn (array $tickRecordData): TickRecord => new TickRecord(...$tickRecordData),
            $response['returnData']['quotations']
        ));
    }
}
