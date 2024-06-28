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
     * @param TickRecord[] $quotations
     */
    public function __construct(public array $quotations)
    {
    }

    /**
     * @inheritdoc
     */
    protected static function create(array $data): static
    {
        $quotations = array_map(function ($tickRecordData) {
            return new TickRecord(...$tickRecordData);
        }, $data['returnData']['quotations']);

        return new static($quotations);
    }
}
