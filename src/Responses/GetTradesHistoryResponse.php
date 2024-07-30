<?php

namespace Timirey\XApi\Responses;

use Override;
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
     * @inheritdoc
     */
    #[Override]
    protected static function create(array $response): self
    {
        return new self(array_map(
            static fn (array $tradeData): TradeRecord => new TradeRecord(...$tradeData),
            $response
        ));
    }
}
