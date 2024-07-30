<?php

namespace Timirey\XApi\Responses;

use Override;
use Timirey\XApi\Responses\Data\ProfitStreamRecord;

/**
 * Class that contains the response of the fetchProfits stream command.
 */
final readonly class FetchProfitsResponse extends AbstractStreamResponse
{
    /**
     * Constructor for the FetchProfitsResponse class.
     *
     * @param  ProfitStreamRecord $profitStreamRecord Profit record data.
     */
    public function __construct(public ProfitStreamRecord $profitStreamRecord)
    {
    }

    /**
     * @inheritdoc
     */
    #[Override]
    protected static function create(array $response): self
    {
        return new self(new ProfitStreamRecord(...$response));
    }
}
