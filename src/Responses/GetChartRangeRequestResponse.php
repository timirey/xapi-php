<?php

namespace Timirey\XApi\Responses;

use Timirey\XApi\Responses\Data\RateInfoRecord;
use Timirey\XApi\Responses\Data\SymbolRecord;

/**
 * Class that contains response of the getChartRangeRequest command.
 */
class GetChartRangeRequestResponse extends AbstractResponse
{
    /**
     * Constructor for GetChartRangeRequestResponse.
     *
     * @param int $digits
     * @param RateInfoRecord[] $rateInfoRecords
     */
    public function __construct(public int $digits, public array $rateInfoRecords)
    {
    }

    /**
     * @inheritdoc
     */
    protected static function create(array $data): static
    {
        $returnData = $data['returnData'];

        $rateInfoRecords = [];

        foreach ($returnData['rateInfos'] as $rateInfoRecordData) {
            $rateInfoRecords[] = new RateInfoRecord(...$rateInfoRecordData);
        }

        return new static($returnData['digits'], $rateInfoRecords);
    }
}
