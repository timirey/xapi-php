<?php

namespace Timirey\XApi\Responses;

use Timirey\XApi\Responses\Data\IbRecord;

/**
 * Class that contains the response of the getIbsHistory command.
 */
readonly class GetIbsHistoryResponse extends AbstractResponse
{
    /**
     * Constructor for GetIbsHistoryResponse.
     *
     * @param  IbRecord[] $ibRecords IbRecord instances.
     */
    final public function __construct(public array $ibRecords)
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
        return new static(array_map(
            static fn (array $ibRecordData): IbRecord => new IbRecord(...$ibRecordData),
            $response['returnData']
        ));
    }
}
