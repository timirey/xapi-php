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
        $symbolRecords = array_map(function ($symbolRecordData) {
            return new SymbolRecord(...$symbolRecordData);
        }, $data['returnData']);

        return new static($symbolRecords);
    }
}
