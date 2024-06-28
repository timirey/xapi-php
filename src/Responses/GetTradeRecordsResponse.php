<?php

namespace Timirey\XApi\Responses;

use Timirey\XApi\Responses\Data\TradeRecord;

/**
 * Class that contains the response of the getTradeRecords command.
 */
class GetTradeRecordsResponse extends AbstractResponse
{
    /**
     * Constructor for GetTradeRecordsResponse.
     *
     * @param TradeRecord[] $tradeRecords
     */
    public function __construct(
        public array $tradeRecords
    ) {
    }

    /**
     * @inheritdoc
     */
    protected static function create(array $data): static
    {
        $tradeRecords = array_map(
            static fn(array $tradeData): TradeRecord => new TradeRecord(...$tradeData),
            $data['returnData']
        );

        return new static(tradeRecords: $tradeRecords);
    }
}
