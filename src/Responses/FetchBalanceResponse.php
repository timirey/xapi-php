<?php

namespace Timirey\XApi\Responses;

use Override;
use Timirey\XApi\Responses\Data\BalanceStreamRecord;

/**
 * Class that contains the response of the fetchBalance stream command.
 */
final readonly class FetchBalanceResponse extends AbstractStreamResponse
{
    /**
     * Constructor for the FetchBalanceResponse class.
     *
     * @param  BalanceStreamRecord $balanceStreamRecord Balance record data.
     */
    public function __construct(public BalanceStreamRecord $balanceStreamRecord)
    {
    }

    /**
     * @inheritdoc
     */
    #[Override]
    protected static function create(array $response): self
    {
        return new self(new BalanceStreamRecord(...$response));
    }
}
