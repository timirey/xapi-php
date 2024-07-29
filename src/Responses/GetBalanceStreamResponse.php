<?php

namespace Timirey\XApi\Responses;

use Timirey\XApi\Responses\Data\BalanceStreamRecord;

/**
 * Class that contains the response of the getBalance stream command.
 */
final readonly class GetBalanceStreamResponse extends AbstractStreamResponse
{
    /**
     * Constructor for the GetBalanceStreamResponse class.
     *
     * @param  BalanceStreamRecord $balanceStreamRecord Balance record data.
     */
    public function __construct(public BalanceStreamRecord $balanceStreamRecord)
    {
    }

    /**
     * Create an instance from the validated data.
     *
     * @param  array<string, mixed> $response Validated response data.
     * @return static Instance of the response.
     */
    protected static function create(array $response): self
    {
        return new self(new BalanceStreamRecord(...$response));
    }
}
