<?php

namespace Timirey\XApi\Responses;

use Timirey\XApi\Responses\Data\SymbolRecord;

/**
 * Class that contains response of the getSymbol command.
 */
readonly class GetSymbolResponse extends AbstractResponse
{
    /**
     * Constructor for GetSymbolResponse.
     *
     * @param  SymbolRecord $symbolRecord SymbolRecord instance.
     */
    final public function __construct(public SymbolRecord $symbolRecord)
    {
    }

    /**
     * Create a response instance from the validated data.
     *
     * @param  array<string, mixed> $response Validated response data.
     * @return static Instance of the response.
     */
    protected static function create(array $response): static
    {
        return new static(new SymbolRecord(...$response['returnData']));
    }
}
