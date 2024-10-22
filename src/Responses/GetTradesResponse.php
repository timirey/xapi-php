<?php

namespace Timirey\XApi\Responses;

use Override;
use Timirey\XApi\Responses\Data\TradeRecord;

/**
 * Class that contains the response of the getTrades command.
 */
final readonly class GetTradesResponse extends AbstractResponse
{
    /**
     * Constructor for GetTradesResponse.
     *
     * @param TradeRecord[] $tradeRecords TradeRecord instances.
     */
    public function __construct(public array $tradeRecords)
    {
    }

    /**
     * @inheritdoc
     */
    #[Override]
    protected static function create(array $response): self
    {
        return new self(array_map(
            static fn(array $tradeRecordData): TradeRecord => new TradeRecord(...$tradeRecordData),
            $response
        ));
    }
}
