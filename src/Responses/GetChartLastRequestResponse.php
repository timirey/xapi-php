<?php

namespace Timirey\XApi\Responses;

use Timirey\XApi\Responses\Data\RateInfoRecord;

/**
 * Class that contains response of the getChartLastRequest command.
 */
class GetChartLastRequestResponse extends AbstractResponse
{
    /**
     * Constructor for GetChartLastRequestResponse.
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
        return new static(
            $data['returnData']['digits'],
            array_map(
                static fn(array $rateInfoRecordData): RateInfoRecord => new RateInfoRecord(...$rateInfoRecordData),
                $data['returnData']['rateInfos']
            )
        );
    }
}
