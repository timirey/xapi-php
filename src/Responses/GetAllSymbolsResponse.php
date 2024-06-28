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
    public function __construct(
        public array $symbolRecords
    ) {
    }

    /**
     * @inheritdoc
     */
    protected static function create(array $data): static
    {
        return new static(
            symbolRecords: array_map(
                static fn(array $symbolRecordData): SymbolRecord => new SymbolRecord(...$symbolRecordData),
                $data['returnData']
            )
        );
    }
}
