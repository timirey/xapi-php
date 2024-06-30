<?php

namespace Timirey\XApi\Responses;

use Timirey\XApi\Responses\Data\TradeRecord;

/**
 * Class that contains the response of the getTradesHistory command.
 */
class GetTradesHistoryResponse extends AbstractResponse
{
    /**
     * Constructor for GetTradesHistoryResponse.
     *
     * @param TradeRecord[] $tradeRecords
     */
    public function __construct(public array $tradeRecords)
    {
    }

    /**
     * @inheritdoc
     */
    protected static function create(array $data): static
    {
        return new static(array_map(
            static fn($tradeData): TradeRecord => new TradeRecord(...$tradeData),
            $data['returnData']
        ));
    }
}
