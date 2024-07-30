<?php

namespace Timirey\XApi\Responses;

use Override;
use Timirey\XApi\Responses\Data\TickStreamRecord;

/**
 * Class that contains the response of the fetchTickPrices stream command.
 */
final readonly class FetchTickPricesResponse extends AbstractStreamResponse
{
    /**
     * Constructor for the FetchTickPricesResponse class.
     *
     * @param  TickStreamRecord $tickStreamRecord Tick record data.
     */
    public function __construct(public TickStreamRecord $tickStreamRecord)
    {
    }

    /**
     * @inheritdoc
     */
    #[Override]
    protected static function create(array $response): self
    {
        return new self(new TickStreamRecord(...$response));
    }
}
