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
    public function __construct(public array $ibRecords)
    {
    }

    /**
     * @inheritdoc
     */
    protected static function create(array $data): static
    {
        $ibRecords = array_map(function ($ibRecordData) {
            return new IbRecord(...$ibRecordData);
        }, $data['returnData']);

        return new static($ibRecords);
    }
}
