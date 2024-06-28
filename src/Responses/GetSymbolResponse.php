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
    public function __construct(
        public SymbolRecord $symbolRecord
    ) {
    }

    /**
     * @inheritdoc
     */
    protected static function create(array $data): static
    {
        return new static(
            symbolRecord: new SymbolRecord(...$data['returnData'])
        );
    }
}
