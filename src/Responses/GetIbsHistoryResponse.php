<?php

namespace Timirey\XApi\Responses;

use Timirey\XApi\Responses\Data\IbRecord;

/**
 * Class that contains the response of the getIbsHistory command.
 */
class GetIbsHistoryResponse extends AbstractResponse
{
    /**
     * Constructor for GetIbsHistoryResponse.
     *
     * @param IbRecord[] $ibRecords
     */
    public function __construct(
        public array $ibRecords
    ) {
    }

    /**
     * @inheritdoc
     */
    protected static function create(array $data): static
    {
        return new static(
            ibRecords: array_map(static function (array $ibRecordData): IbRecord {
                return new IbRecord(...$ibRecordData);
            }, $data['returnData'])
        );
    }
}
