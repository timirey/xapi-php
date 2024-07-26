<?php

namespace Timirey\XApi\Responses;

use Timirey\XApi\Responses\Data\TradeRecord;

/**
 * Class that contains the response of the getTradeRecords command.
 */
readonly class GetTradeRecordsResponse extends AbstractResponse
{
    /**
     * Constructor for GetTradeRecordsResponse.
     *
     * @param  TradeRecord[] $tradeRecords TradeRecord instances.
     */
    final public function __construct(public array $tradeRecords)
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
            static fn (array $tradeRecordData): TradeRecord => new TradeRecord(...$tradeRecordData),
            $response['returnData']
        ));
    }
}
