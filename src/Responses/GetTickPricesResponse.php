<?php

namespace Timirey\XApi\Responses;

use Timirey\XApi\Responses\Data\TickRecord;

/**
 * Class that contains the response of the getTickPrices command.
 */
class GetTickPricesResponse extends AbstractResponse
{
    /**
     * Constructor for GetTickPricesResponse.
     *
     * @param  TickRecord[]  $quotations  TickRecord instances, aka Quotations.
     */
    public function __construct(public array $quotations) {}

    /**
     * Create a response instance from the validated data.
     *
     * @param  array  $data  Validated response data.
     * @return static Instance of the response.
     */
    protected static function create(array $data): static
    {
        return new static(array_map(
            static fn (array $tickRecordData): TickRecord => new TickRecord(...$tickRecordData),
            $data['returnData']['quotations']
        ));
    }
}
