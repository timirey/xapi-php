<?php

namespace Timirey\XApi\Responses;

use Timirey\XApi\Responses\Data\SymbolRecord;

/**
 * Class that contains response of the getSymbol command.
 */
class GetSymbolResponse extends AbstractResponse
{
    /**
     * Constructor for GetSymbolResponse.
     *
     * @param SymbolRecord $symbolRecord
     */
    public function __construct(public SymbolRecord $symbolRecord)
    {
    }

    /**
     * @inheritdoc
     */
    protected static function create(array $data): static
    {
        $symbolRecordData = $data['returnData'];

        $symbolRecord = new SymbolRecord(...$symbolRecordData);

        return new static($symbolRecord);
    }
}
