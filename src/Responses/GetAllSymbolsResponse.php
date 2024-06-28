<?php

namespace Timirey\XApi\Responses;

use Timirey\XApi\Responses\Data\SymbolRecord;

/**
 * Class that contains response of the getAllSymbols command.
 */
class GetAllSymbolsResponse extends AbstractResponse
{
    /**
     * Constructor for GetAllSymbolsResponse.
     *
     * @param SymbolRecord[] $symbolRecords
     */
    public function __construct(public array $symbolRecords)
    {
    }

    /**
     * @inheritdoc
     */
    protected static function create(array $data): static
    {
        $returnData = $data['returnData'];

        $symbolRecords = [];

        foreach ($returnData as $symbolRecordData) {
            $symbolRecords[] = new SymbolRecord(...$symbolRecordData);
        }

        return new static($symbolRecords);
    }
}
