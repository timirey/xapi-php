<?php

namespace Timirey\XApi\Responses;

use Override;
use Timirey\XApi\Responses\Data\SymbolRecord;

/**
 * Class that contains response of the getAllSymbols command.
 */
final readonly class GetAllSymbolsResponse extends AbstractResponse
{
    /**
     * Constructor for GetAllSymbolsResponse.
     *
     * @param  SymbolRecord[] $symbolRecords SymbolRecord instances.
     */
    public function __construct(public array $symbolRecords)
    {
    }

    /**
     * @inheritdoc
     */
    #[Override]
    protected static function create(array $response): self
    {
        return new self(array_map(
            static fn (array $symbolRecordData): SymbolRecord => new SymbolRecord(...$symbolRecordData),
            $response
        ));
    }
}
