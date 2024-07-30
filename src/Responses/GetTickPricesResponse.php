<?php

namespace Timirey\XApi\Responses;

use Override;
use Timirey\XApi\Responses\Data\TickRecord;

/**
 * Class that contains the response of the getTickPrices command.
 */
final readonly class GetTickPricesResponse extends AbstractResponse
{
    /**
     * Constructor for GetTickPricesResponse.
     *
     * @param  TickRecord[] $quotations TickRecord instances, aka Quotations.
     */
    public function __construct(public array $quotations)
    {
    }

    /**
     * @inheritdoc
     */
    #[Override]
    protected static function create(array $response): self
    {
        return new self(array_map(
            static fn (array $tickRecordData): TickRecord => new TickRecord(...$tickRecordData),
            $response['quotations']
        ));
    }
}
