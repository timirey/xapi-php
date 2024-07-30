<?php

namespace Timirey\XApi\Responses;

use Override;
use Timirey\XApi\Responses\Data\IbRecord;

/**
 * Class that contains the response of the getIbsHistory command.
 */
final readonly class GetIbsHistoryResponse extends AbstractResponse
{
    /**
     * Constructor for GetIbsHistoryResponse.
     *
     * @param  IbRecord[] $ibRecords IbRecord instances.
     */
    public function __construct(public array $ibRecords)
    {
    }

    /**
     * @inheritdoc
     */
    #[Override]
    protected static function create(array $response): self
    {
        return new self(array_map(
            static fn (array $ibRecordData): IbRecord => new IbRecord(...$ibRecordData),
            $response
        ));
    }
}
