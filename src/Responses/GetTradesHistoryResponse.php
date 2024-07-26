<?php

namespace Timirey\XApi\Responses;

use Timirey\XApi\Responses\Data\TradeRecord;

/**
 * Class that contains the response of the getTradesHistory command.
 */
final readonly class GetTradesHistoryResponse extends AbstractResponse
{
    /**
     * Constructor for GetTradesHistoryResponse.
     *
     * @param  TradeRecord[] $tradeRecords TradeRecord instances.
     */
    public function __construct(public array $tradeRecords)
    {
    }

    /**
     * Create a response instance from the validated data.
     *
     * @param array<string, mixed> $response Validated response data.
     * @return static Instance of the response.
     */
    protected static function create(array $response): self
    {
        return new self(array_map(
            static fn (array $tradeData): TradeRecord => new TradeRecord(...$tradeData),
            $response['returnData']
        ));
    }
}
