<?php

namespace Timirey\XApi\Responses;

use Override;
use Timirey\XApi\Responses\Data\SymbolRecord;

/**
 * Class that contains response of the getSymbol command.
 */
final readonly class GetSymbolResponse extends AbstractResponse
{
    /**
     * Constructor for GetSymbolResponse.
     *
     * @param  SymbolRecord $symbolRecord SymbolRecord instance.
     */
    public function __construct(public SymbolRecord $symbolRecord)
    {
    }

    /**
     * @inheritdoc
     */
    #[Override]
    protected static function create(array $response): self
    {
        return new self(new SymbolRecord(...$response));
    }
}
