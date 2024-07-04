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
     * @param  SymbolRecord[]  $symbolRecords  SymbolRecord instances.
     */
    public function __construct(public array $symbolRecords) {}

    /**
     * Create a response instance from the validated data.
     *
     * @param  array  $data  Validated response data.
     * @return static Instance of the response.
     */
    protected static function create(array $data): static
    {
        return new static(array_map(
            static fn (array $symbolRecordData): SymbolRecord => new SymbolRecord(...$symbolRecordData),
            $data['returnData']
        ));
    }
}
